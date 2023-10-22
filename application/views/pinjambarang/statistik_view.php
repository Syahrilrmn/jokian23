<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <!-- ... (code lainnya) ... -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- ... (box header lainnya) ... -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Laporan Statistik Peminjam dan Pengembalian</h3>
                            <!-- ... (box tools lainnya) ... -->
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="barChart" style="height: 230px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
var perbulanData = <?php echo json_encode($perbulan_data); ?>;
var months = perbulanData.map(entry => new Date(entry.month + '-01').toLocaleDateString('en-US', { month: 'long' }));
var dipinjam = perbulanData.map(entry => entry.dipinjam);
var dikembalikan = perbulanData.map(entry => entry.dikembalikan);

var barChart = new Chart(document.getElementById("barChart"), {
    type: 'bar',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Dipinjam',
                backgroundColor: 'rgba(0, 123, 255, 0.7)',
                data: dipinjam
            },
            {
                label: 'Di Kembalikan',
                backgroundColor: 'rgba(40, 167, 69, 0.7)',
                data: dikembalikan
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                stacked: true
            },
            y: {
                stacked: true
            }
        }
    }
});

</script>
</div>
