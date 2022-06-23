<div class="x_panel">
	<div class="x_title">
	<h2>Total Monthly Sales <small></small></h2>
	<ul class="nav navbar-right panel_toolbox">
		<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		</li>
		<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
		<ul class="dropdown-menu" role="menu">
			<li><a href="#">Settings 1</a>
			</li>
			<li><a href="#">Settings 2</a>
			</li>
		</ul>
		</li>
		<li><a class="close-link"><i class="fa fa-close"></i></a>
		</li>
	</ul>
	<div class="clearfix"></div>
	</div>
	<div class="x_content">
	<div id="graph"></div>
		<table id="example1" class="table table-bordered table-striped">
		<tr>
		<th>MONTH</th>
		<th class="text-right">SALES</th>
	</tr>
			
                    
                    <tbody>
<?php
	$_SESSION['branch']=$_GET['id'];
	$year=date("Y");
	$query=mysqli_query($con,"select *,SUM(product_price) as price from t_products")or die(mysqli_error($con));
			$total=0;
			while($row=mysqli_fetch_array($query)){
				$total=$total+$row['sales'];	
?>
            
			<tr>
                <th><?php echo$row['month'];?></th>
				<td class="text-right"><b><?php echo number_format($row['sales'],2);?></b></td>
			</tr>
	<?php }?>	
			<tr>
                <th><h2>TOTAL</h2></th>
				<th class="text-right"><h2><b><?php echo number_format($total,2);?></b></h2></td>
			</tr>
	            </tbody>
                    <tfoot>
					
         				  
       
        </tfoot>
       </table>
			
										  </div>
										</div>
							</div>
							</div>
					</div> 
					<script type="text/javascript">
    $(document).ready(function() {
      var options = {
              chart: {
                  renderTo: 'graph',
                  type: 'column',
                  marginRight: 20,
                  marginBottom: 25
              },
              title: {
                  text: '',
                  x: -20 //center
              },
              subtitle: {
                  text: '',
                  x: -10
              },
              xAxis: {
                  categories: []
              },
              yAxis: {
                  
                  title: {
                      text: 'Total Monthly Sales'
                  },
                  plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                  }]
              },
              tooltip: {
                  formatter: function() {
                          return '<b>'+ this.series.name +'</b><br/>'+  Highcharts.numberFormat(this.y, 0)
                          this.x +': '+ this.y
                          
                  ;
                  }
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'top',
                  x: 0,
                  y: 100,
                  borderWidth: 0
              },
              series: []
          }
          
          $.getJSON("data.php", function(json) {
			options.xAxis.categories = json[0]['name'];
            options.series[0] = json[1];
            //options.series[1] = json[2];
            
            
            
            chart = new Highcharts.Chart(options);
          });
      });
    </script>
	<?php include 'datatable_script.php';?>
    <!-- /gauge.js -->			
						