<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Kmeans;
use App\Models\Stunting;
use App\Models\VariablePenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KmeansController extends Controller
{
    function kMeansClustering($data, $k)
    {
        // Ubah data ke dalam format yang hanya berisi nilai untuk variabel yang dianalisis
        $dataPoints = [];
        foreach ($data as $item) {
            $dataPoints[] = [$item[1], $item[2]];
        }

        // Inisialisasi centroid awal secara acak
        $centroids = $this->initializeCentroids($dataPoints, $k);

        // Inisialisasi array cluster
        $clusters = [];
        for ($i = 0; $i < $k; $i++) {
            $clusters[$i] = [];
        }

        $iteration = 0;
        $maxIterations = 100;

        // Iterasi hingga konvergen atau mencapai batas iterasi maksimum
        while ($iteration < $maxIterations) {
            // Mengosongkan cluster pada setiap iterasi
            for ($i = 0; $i < $k; $i++) {
                $clusters[$i] = [];
            }

            // Mengelompokkan data ke dalam cluster terdekat
            foreach ($dataPoints as $index => $point) {
                $centroidIndex = $this->findClosestCentroid($point, $centroids);
                $clusters[$centroidIndex][] = $index;
            }

            // Menghitung centroid baru
            $newCentroids = [];
            for ($i = 0; $i < $k; $i++) {
                $newCentroids[$i] = $this->calculateCentroid($dataPoints, $clusters[$i]);
            }

            // Mengecek konvergensi
            if ($this->hasConverged($centroids, $newCentroids)) {
                break;
            }

            $centroids = $newCentroids;
            $iteration++;
        }

        // Menambahkan informasi kluster (label "rendah", "sedang", "parah") pada setiap baris data awal
        foreach ($data as $index => $item) {
            $clusterIndex = -1;
            foreach ($clusters as $i => $cluster) {
                if (in_array($index, $cluster)) {
                    $clusterIndex = $i;
                    break;
                }
            }

            $label = "";
            if ($clusterIndex == 0) {
                $label = 0;
            } elseif ($clusterIndex == 1) {
                $label = 1;
            } else {
                $label = 2;
            }

            $item[] = $label;
            $data[$index] = $item;
        }

        return $data;
    }

    function initializeCentroids($data, $k)
    {
        $centroids = [];
        $numDimensions = count($data[0]);

        for ($i = 0; $i < $k; $i++) {
            $centroid = [];
            for ($j = 0; $j < $numDimensions; $j++) {
                $centroid[] = rand(0, 10); // Mengubah rentang angka sesuai kebutuhan
            }
            $centroids[] = $centroid;
        }

        return $centroids;
    }

    function findClosestCentroid($item, $centroids)
    {
        $minDistance = PHP_INT_MAX;
        $closestCentroidIndex = -1;

        foreach ($centroids as $index => $centroid) {
            $distance = $this->euclideanDistance($item, $centroid);
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $closestCentroidIndex = $index;
            }
        }

        return $closestCentroidIndex;
    }

    function euclideanDistance($item, $centroid)
    {
        $sum = 0;
        for ($i = 0; $i < count($item); $i++) {
            $sum += pow($item[$i] - $centroid[$i], 2);
        }
        return sqrt($sum);
    }

    function calculateCentroid($dataPoints, $cluster)
    {
        $centroid = [];
        $numDimensions = count($dataPoints[0]);
        $count = count($cluster);

        for ($i = 0; $i < $numDimensions; $i++) {
            $sum = 0;
            foreach ($cluster as $index) {
                $sum += $dataPoints[$index][$i];
            }
            $centroid[] = $count == 0 ? 0 : $sum / $count;
        }

        return $centroid;
    }

    function hasConverged($oldCentroids, $newCentroids)
    {
        $tolerance = 0.001;

        for ($i = 0; $i < count($oldCentroids); $i++) {
            $oldCentroid = $oldCentroids[$i];
            $newCentroid = $newCentroids[$i];

            $distance = $this->euclideanDistance($oldCentroid, $newCentroid);

            if ($distance > $tolerance) {
                return false;
            }
        }

        return true;
    }

    public function index()
    {
        $cluster = Cluster::orderBy('order', 'asc')->get();
        $stunting = Stunting::all()->toArray();
        $variable = VariablePenilaian::all()->toArray();
        $variables = [];

        for ($i = 0; $i < count($variable); $i++) {
            $variables[] = Str::snake($variable[$i]['name']);
        }

        $data = [];
        $k = count($cluster);

        for ($i = 0; $i < count($stunting); $i++) {
            $tmp = [$stunting[$i]['id']];
            for ($j = 0; $j < count($variables); $j++) {
                $tmp[] = $stunting[$i][$variables[$j]];
            }
            $data[] = $tmp;
        }

        $clusterResult = $this->kMeansClustering($data, $k);


        $countVariable = count($variable);

        $tmpSUM = [];
        for ($i = 0; $i < $k; $i++) {
            $tmpCount = [];
            $tmpSum = [];
            $tmpAvg = [];
            for ($j = 0; $j < $countVariable; $j++) {
                $tmpCount[] = 0;
                $tmpSum[] = 0;
                $tmpAvg[] = 0;
            }
            $tmpSUM[$i]['cluster'] = $i;
            foreach ($clusterResult as $item) {
                if ($item[count($item) - 1] == $i) {
                    $tmpSUM[$i]['element'][] = $item;
                    for ($j = 1; $j <= $countVariable; $j++) {
                        $tmpSum[$j - 1] += $item[$j];
                        $tmpCount[$j - 1] += 1;
                    }
                }
            }
            $tmpSUM[$i]['sum'] = $tmpSum;
            $tmpSUM[$i]['count'] = $tmpCount;
            for ($l = 0; $l < $countVariable; $l++) {
                $tmpAvg[$l] = $tmpSum[$l] / $tmpCount[$l];
            }

            $tmpSUM[$i]['avg'] = array_sum($tmpAvg) / count($tmpAvg);
        }

        usort($tmpSUM, function ($a, $b) {
            return  $a["avg"] - $b["avg"];
        });

        $clusterArr = $cluster->toArray();
        for ($m = 0; $m < count($tmpSUM); $m++) {
            $tmpSUM[$m]['label'] = $clusterArr[$m];
        }

        for ($j = 0; $j < count($stunting); $j++) {
            for ($i = 0; $i < count($clusterResult); $i++) {
                if ($clusterResult[$i][0] == $stunting[$j]['id']) {
                    $clusterElement = $clusterResult[$i][count($clusterResult[$i]) - 1];
                    for ($n = 0; $n < count($tmpSUM); $n++) {
                        if ($tmpSUM[$n]['cluster'] == $clusterElement) {
                            $stunting[$j]['label'] = $tmpSUM[$n]['label'];
                        }
                    }
                    $stunting[$j]['cluster'] = $clusterElement;
                }
            }
            $tmpCluster = Kmeans::firstOrCreate(['stunting_id' => $stunting[$j]['id']]);
            $tmpCluster->cluster_id = $stunting[$j]['label']['id'];
            $tmpCluster->save();
        }



        return view('admin.kmeans.index', compact('stunting'));
    }
}
