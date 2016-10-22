<?php

/* @var $this yii\web\View */

$this->title = 'Advisor Hunter';
$NewCompany = Yii::$app->Helpers->NumberOfNewCompany(2);
$NewUsers = Yii::$app->Helpers->NumberOfNewCompany(2);
$NewLeads = Yii::$app->Helpers->NumberOfNewCompany(2);
$NewProjects = Yii::$app->Helpers->NumberOfNewCompany(2);
?>
<center>
    <h1>Welcome!</h1>

        
        <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <h3><?php echo $NewUsers; ?></h3>
                  <p>New Users</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-plus"></i>
                </div>
                <a href="?r=userdetails" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                <h3><?php echo $NewCompany; ?></h3>
                  <p>New Company</p>
                </div>
                <div class="icon">
                  <i class="fa fa-hourglass-half"></i>
                </div>
                <a href="?r=company" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                <h3><?php echo $NewLeads; ?></h3>
                  <p>New Leads</p>
                </div>
                <div class="icon">
                  <i class="fa fa-line-chart"></i>
                </div>
                <a href="?r=lead" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                <h3><?php echo $NewProjects; ?></h3>
                  <p>New Projects</p>
                </div>
                <div class="icon">
                  <i class="fa fa-pie-chart"></i>
                </div>
                <a href="?r=project" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>  
          
          <div class="row">
          <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Users</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" style="height: 249px; width: 555px;" width="1110" height="498"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
           
           <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Company</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" style="height: 249px; width: 555px;" width="1110" height="498"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
           </div>
           
           <div class="row">
          <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Leads</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" style="height: 249px; width: 555px;" width="1110" height="498"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
           
           <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Projects</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" style="height: 249px; width: 555px;" width="1110" height="498"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div>
           </div>
           
           
            
            	
          </section>
          
          
           

</center>


        
