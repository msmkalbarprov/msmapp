  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= trans('dashboard') ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
              <li class="breadcrumb-item active"><?= trans('dashboard') ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <font size="5px"><b><?= $all_proyek_count; ?></b></font>

                <p><b><?= number_format($all_proyek['nilai'],2,',','.'); ?></b> <br> Proyek/Pekerjaan</p>
              </div>
              <div class="icon">
                <font color="#0A62A9"><i class="ion ion-bookmark"></i></font>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <font size="5px"><b><?= $all_proyek_cair_count; ?></b></font>

                <p><b>Rp <?= number_format($all_proyek_cair['nilai'],2,',','.'); ?></b> <br> PDP</p>
              </div>
              <div class="icon">
                <font color="#50B83C"><i class="ion ion-ios-download"></i></font>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <font size="5px"><b><?= $all_pdo_count; ?></b></font>

                <p><b><?= number_format($all_pdo['nilai'],2,',','.'); ?> </b><br> PDO</p>
              </div>
              <div class="icon">
                <font color="#D91331"><i class="ion ion-bag"></i></font>
              </div>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <font size="5px"><b><?= $all_spj_count; ?></b></font>

                <p><b><?= number_format($all_spj['nilai'],2,',','.'); ?></b> <br> SPJ</p>
              </div>
              <div class="icon">
                <font color="#267778"><i class="ion ion-ios-upload"></i></font>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header no-border">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Proyek, PDP, PDO, dan SPJ</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span>Nilai </span>
                  </p>
         
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fa fa-square text-primary"></i> Proyek
                  </span>

                  <span class="mr-2">
                    <i class="fa fa-square text-success"></i> PDP
                  </span>

                  <span class="mr-2">
                    <i class="fa fa-square text-danger"></i> PDO
                  </span>

                  <span class="mr-2">
                    <i class="fa fa-square text-warning"></i> SPJ
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

          
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!-- <script src="<?= base_url() ?>assets/dist/js/pages/dashboard3.js"></script> -->
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/autoCurrency.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/numberFormat.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>

<script type="text/javascript">
  
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true
  

  var data_proyek = <?php echo $proyek; ?>;  
  var data_pdp = <?php echo $pdp; ?>; 
  var data_pdo = <?php echo $pdo; ?>; 
  var data_spj = <?php echo $spj; ?>; 
  var data_area= <?php echo $area; ?>; 


  var $salesChart = $('#sales-chart')
  $salesChart.height(400);
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : data_area
      ,
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : data_proyek
        },
        {
          backgroundColor: '#28a745',
          borderColor    : '#28a745',
          data           : data_pdp
        },
        {
          backgroundColor: '#dc3545',
          borderColor    : '#dc3545',
          data           : data_pdo
        },
        {
          backgroundColor: '#ffc107',
          borderColor    : '#ffc107',
          data           : data_spj
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '1px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              return 'Rp ' + number_format(value,'2',',','.')
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })

</script>