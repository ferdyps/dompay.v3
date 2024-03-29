 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-12 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="no-gutters text-center">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Saldo</div>
          <div class="h2 mb-0 font-weight-bold text-gray-800">
            <span class="text-xs">Rp.</span> <?= number_format($this->totalSaldo, 2, ",", "."); ?>-
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->

<div class="row">

  <!-- Area Chart -->
  <div class="col-xl-6 col-lg-6">
    <div class="card border-left-danger shadow mb-4">
      <!-- Card Body -->
      <div class="card-body">
        <div id="chartDebit" style="min-height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-lg-6">
    <div class="card border-left-success shadow mb-4">
      <!-- Card Body -->
      <div class="card-body">
        <div id="chartKredit" style="min-height: 370px; width: 100%;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
      </div>
      <div class="card-body">
        <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>

    <!-- Color System -->
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card bg-primary text-white shadow">
          <div class="card-body">
            Primary
            <div class="text-white-50 small">#4e73df</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-success text-white shadow">
          <div class="card-body">
            Success
            <div class="text-white-50 small">#1cc88a</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-info text-white shadow">
          <div class="card-body">
            Info
            <div class="text-white-50 small">#36b9cc</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-warning text-white shadow">
          <div class="card-body">
            Warning
            <div class="text-white-50 small">#f6c23e</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-danger text-white shadow">
          <div class="card-body">
            Danger
            <div class="text-white-50 small">#e74a3b</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card bg-secondary text-white shadow">
          <div class="card-body">
            Secondary
            <div class="text-white-50 small">#858796</div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
      </div>
      <div class="card-body">
        <div class="text-center">
          <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="#" alt="">
        </div>
        <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
      </div>
    </div>

    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
      </div>
      <div class="card-body">
        <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
        <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
      </div>
    </div>

  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
  $(window).on('load', function() {
      var chartDebit = new CanvasJS.Chart("chartDebit", {
        animationEnabled: true,
        theme: "light2",
        title:{
          text: "Transaksi Debit"
        },
        axisX: {
          valueFormatString: "DD MMM YYYY"
        },
        axisY: {
          title: "Total Debit"
        },
        toolTip:{
          content:"<span style='\"'color: #e74a3b;'\"'>{x}</span> <br> <small>Rp.</small>{y}"
        },
        data: [{
          type: "splineArea",
          color: "#e74a3b",
          xValueType: "dateTime",
          xValueFormatString: "DD MMM YYYY",
          dataPoints: <?php echo json_encode($dataPointsDebit, JSON_NUMERIC_CHECK); ?>
        }]
      });

      var chartKredit = new CanvasJS.Chart("chartKredit", {
        animationEnabled: true,
        theme: "light2",
        title:{
          text: "Transaksi Kredit"
        },
        axisX: {
          valueFormatString: "DD MMM YYYY"
        },
        axisY: {
          title: "Total Kredit"
        },
        toolTip:{
          content:"<span style='\"'color: #1cc88a;'\"'>{x}</span> <br> <small>Rp.</small>{y}"
        },
        data: [{
          type: "splineArea",
          color: "#1cc88a",
          xValueType: "dateTime",
          xValueFormatString: "DD MMM YYYY",
          dataPoints: <?php echo json_encode($dataPointsKredit, JSON_NUMERIC_CHECK); ?>
        }]
      });

      chartKredit.render();
      chartDebit.render();
  });
  </script>