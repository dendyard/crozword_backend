<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>Cari Decolgen Dashboard</title>
     
    <meta name="msapplication-TileColor" content="#ffdf01">
    
    <meta name="theme-color" content="#ffdf01">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://apis.caridecolgen.id/assets/css/bootstrap.min.css" rel="stylesheet">

  </head>
    <body>
                
<div class="content">
            <div class="container-fluid">
                
                
                <div class="row" style='margin-bottom:30px'>
                  <div class="col-md-4"></div>
                  <div class="col-md-4" style='margin-top:30px; font-size:20px'>
                  <center> <b>TOTAL Game Play : <?=$totalplay['totalplay']?></b></center>
                  </div>
                  <div class="col-md-4" style='margin-top:30px; font-size:18px'><a href='<?=base_url()?>adv/export_csv_process'>Export Data</a></div>

                </div>
<div class="row">
<div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">

            <div class="content">
            
                <table style="padding-left:10px; padding-right:10px;" id='dashboard' class="table table-hover table-striped">
                    <thead>
                        <th style="width:300px;">User Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>IG Account</th>
                        <th style='text-align:right'>Score</th>
                        <th style='text-align:right; width:150px;'>Duration (sec)</th>
                        <th style='text-align:right; width:300px;'>In Time</th>
                    </thead>
                    <tbody>
                    <?php
                    echo count($userList);
                      foreach ($userList as $list) {
                        ?>
                        <tr>
                         <td ><?=$list['uname'];?></td>
                         <td ><?=$list['uemail'];?></td>
                         <td ><?=$list['uphone'];?></td>
                         <td ><?=$list['uig'];?></td>
                         <td style='text-align:right'><?=$list['uscore'];?></td>
                         <td style='text-align:right'><?=$list['utime'];?></td>
                         <td style='text-align:right'><?=$list['intime'];?></td>
                        </tr>

                        <?php
                          
                      }
                     ?>  

                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <div class="col-md-2"></div>




</div>
            </div>
        </div>

        </div>
    </div>
    </div>
</div> 
</body>
</html>
