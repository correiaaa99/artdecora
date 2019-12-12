<?php
use backend\Controllers\UserController;
use backend\Controllers\IdeaBookController;
use backend\Controllers\ProjectController;  
use backend\Controllers\RequestController;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\Project;
use backend\models\Request;
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
use yii\db\Expression;
/* @var $this yii\web\View */
$this->title = '';
?>
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-top:-2%">
      <h1>
        Painel de Controlo
      </h1>
    
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= UserController::getUsers()?></h3>
              <p>Utilizadores</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="/user/index" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= RequestController::getRequests();?></h3>
              <p>Pedidos</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar"></i>
            </div>
            <a href="/request/index" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= ProjectController::getProjects()?></h3>
              <p>Projetos</p>
            </div>
            <div class="icon">
              <i class="fa fa-home"></i>
            </div>
            <a href="/project/index" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="small-box bg-yellow">
          <div class="inner">
              <h3><?= IdeaBookController::getCountBook();?></h3>
              <p>Livro de ideias</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="/idea-book/index" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">     
          <?php 
            $array = array();
            $arraySoma = array();
            $dataProjects = Project::find()->select([new Expression('SUM(evalution)/COUNT(tbl_project_user.idProject) AS total'), 'name'])
            ->rightJoin('tbl_project_user', 'tbl_project_user.idProject = tbl_project.idProject')
            ->orderBy('total asc')
            ->groupBy(['tbl_project.idProject'])
            ->limit(10)
            ->asArray()
            ->all();
            foreach($dataProjects as $data => $value)
            {
              array_push($array, $value['name']);
              array_push($arraySoma, $value['total']);
            }
          ?>
          <?= ChartJs::widget([
              'type' => 'line',
              'options' => [
                  'height' => 400,
                  'width' => 400
              ],
              
              'data' => [      
                  'labels' => $array,
                  'datasets' => [
                      [
                          'label' => "Projetos - Avaliação (top 10  -  ★) ",
                          'backgroundColor' => "rgba(1,166,90,0.6)",
                          'borderColor' => "rgba(1, 141, 78,2)",
                          'pointBackgroundColor' => "rgba(1, 141, 78,2)",
                          'pointBorderColor' => "rgba(1, 141, 78,2)",
                          'pointHoverBackgroundColor' => "#fff",
                          'pointHoverBorderColor' => "rgba('0,149,82,1)",
                          'data' => $arraySoma,
                      ],      
                  ]
              ]
          ]);
          ?>
        </div>
        <div class="col-md-6">
        <?php 
            $array = array();
            $arraySoma = array(); 
            foreach(UserController::getUsersRequestsDashboard() as $data => $value)
            {
              array_push($array, $value['username']);
              array_push($arraySoma, $value['total']);
            }
          ?>
          <?= ChartJs::widget([
              'type' => 'line',
              'options' => [
                  'height' => 400,
                  'width' => 400
              ],
              
              'data' => [      
                  'labels' => $array,
                  'datasets' => [
                      [
                          'label' => "Contador de pedidos - Utilizadores (top 10  -  ★) ",
                          'backgroundColor' => "rgba(221,76,57,0.5)",
                          'borderColor' => "rgba(199,65,53,2)",
                          'pointBackgroundColor' => "rgba(199,65,53,2)",
                          'pointBorderColor' => "rgba(199,65,53,2)",
                          'pointHoverBackgroundColor' => "rgba(221,76,57,0.5)",
                          'pointHoverBorderColor' => "rgba(199,65,53,2)",
                          'data' => $arraySoma,
                      ],      
                  ]
              ]
          ]);
          ?>
        </div>
      </div>
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
          <!-- /.box -->
            <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Últimos utilizadores</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                  <?php $users = User::find()->select(['name', 'surname', 'username', 'photo'])->asArray()
                  ->orderBy('idUser desc')
                  ->limit(8)
                  ->all();?>
                    <?php foreach($users as $data => $value)
                    {
                      ?>
                        <li>
                          <?php 
                          if($value['photo'] == null)
                          {
                            echo '<img src="images/semimagem.png" alt="Não tem imagem  " style="width:50%;height:50%">';
                          }
                          else
                          {
                            echo '<img src="'.$value['photo'].'" alt="Não tem imagem  " style="width:50%;height:50%">';
                          }
                          ?>
                       
                          <a class="users-list-name"><?php echo $value['username'];   ?></a>
                          <span class="users-list-date"><?php echo $value['name'] . ' ' . $value['surname'] ?></span>
                        </li>
                      <?php
                    }
                  ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->    
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Últimos pedidos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Identificador</th>
                    <th>Descrição</th>
                    <th>Estado</th>
                    <th>Utilizador</th>
                    <th>Endereço</th>
                    <th>Projeto</th>
                  </tr>
                  </thead>
                  <tbody>               
                      <?php foreach(RequestController::getRequestDashboards() as $data => $value)
                      {
                        ?>
                        <tr>
                        <td><?php echo $value['idRequest']?></td>
                        <td><?php echo $value['descricao']?></td>
                        <td>
                        <?php if($value['estado'] == 'a')
                        {
                          ?>
                          <span class="label label-danger"><?php { echo 'Pendente';} ?></span>
                          <?php
                        }
                        else if($value['estado'] == 'b')
                        {
                          ?>
                          <span class="label label-warning"><?php { echo 'Em processamento';} ?></span>
                          <?php
                        }
                        else
                        {
                          ?>
                          <span class="label label-success"><?php { echo 'Finalizado';} ?></span>
                          <?php
                        }
                        ?>
                        </td>
                        <td><?php echo $value['username']?></td>
                        <td><?php echo $value['address_name']?></td>  
                        <td><?php echo $value['name']?></td>    
                        </tr>    
                        <?php 
                      }
                    
                      ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="/request/create" class="btn btn-sm btn-default btn-flat pull-left">Criar novo pedido</a>
              <a href="/request/index" class="btn btn-sm btn-default btn-flat pull-right">Ver todos os pedidos</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

      
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
  