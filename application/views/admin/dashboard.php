<section id="content">
      <section class="vbox">
        
        <?php $this->load->view('admin/subheader'); ?>

        <section class="scrollable" id="pjax-container">
          <header>
            <div class="row b-b m-l-none m-r-none">
              <div class="col-sm-4">
                <h3 class="m-t m-b-none">Dashboard</h3>
                <p class="block text-muted">Welcome Admin</p>
              </div>
              <!-- <div class="col-sm-8">
                <div class="clearfix m-t-lg m-b-sm pull-right pull-none-xs">
                  <div class="pull-left">                  
                    <div class="pull-left m-r-xs">
                      <span class="block">Users <span class="badge up bg-danger">+5</span></span>                    
                      <span class="h4">432k</span>
                      <i class="fa fa-level-up text-success"></i>
                    </div>
                    <div class="clear">
                      <div class="sparkline inline" data-type="bar" data-height="35" data-bar-width="4" data-bar-spacing="2" data-stacked-bar-color="['#afcf6f', '#eee']">5:5,8:4,12:5,10:6,11:7,12:2,8:6</div>
                    </div>
                  </div>
                  <div class="pull-left m-l-lg">
                    <div class="pull-left m-r-xs">
                      <span class="block">Profit</span>                    
                      <span class="h4">$4k</span>
                      <i class="fa fa-level-down text-danger"></i>
                    </div>
                    <div class="clear">
                      <div class="sparkline inline" data-type="bar" data-height="35" data-bar-width="4" data-bar-spacing="2" data-bar-color="#fb6b5b">6,5,8,9,6,3,5</div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- <div class="wrapper bg-light font-bold">
              <a href="#" class="m-r"><i class="fa fa-bar-chart-o fa-2x icon-muted v-middle"></i> Analysis</a>
              <a href="#" class="m-r"><span class="badge up m-r-n bg-danger">4</span><i class="fa fa-envelope fa-2x icon-muted  v-middle"></i> Message</a>
              <a href="#" class="m-r"><i class="fa fa-calendar fa-2x icon-muted  v-middle"></i> My Calendar</a>
              <a href="#"><i class="fa fa-cog fa-2x icon-muted  v-middle"></i> Settings</a>
            </div> -->
          </header>
          <!-- <section  class="hbox">
            <aside class="bg-white-only">
              <header class="bg-light">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab1" data-toggle="tab">Trade Market</a></li>
                  <li class=""><a href="#tab2" data-toggle="tab">Events</a></li>
                  <li class=""><a href="#tab3" data-toggle="tab">Interaction</a></li>
                </ul>
              </header>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                  <div class="wrapper">
                    <div id="hero-area" class="graph"></div>
                    <div class="row m-t-lg">
                      <div class="col-md-6">
                        <section class="panel">
                          <header class="panel-heading">Composite</header>
                          <div class="text-center clearfix">
                            <div class="m-t-lg padder">
                              <div class="sparkline" data-type="line" data-resize="true" data-height="100" data-width="100%" data-line-width="1" data-line-color="#dddddd" data-spot-color="#afcf6f" data-fill-color="" data-highlight-line-color="#eee" data-spot-radius="4" data-data="[330,250,200,325,350,380,250,320,345,450,250,250]"></div>
                              <div class="sparkline inline" data-type="bar" data-height="57" data-bar-width="6" data-bar-spacing="10" data-bar-color="#c5d5d5">5,8,12,10,11,12,8,9,6,7,8,6,10,7</div>
                            </div>
                          </div>
                          <footer class="panel-footer text-sm">Check more data</footer>
                        </section>
                      </div>
                      <div class="col-md-6">
                        <section class="panel">
                          <header class="panel-heading">Stacked</header>
                          <div class="panel-body text-center">
                            <div class="sparkline inline" data-type="bar" data-height="160" data-bar-width="12" data-bar-spacing="10" data-stacked-bar-color="['#afcf6f', '#eee']">5:5,8:4,12:5,10:6,11:7,12:2,8:6,9:3,5:5,4:9</div>
                            <ul class="list-inline text-muted axis"><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li><li>10</li></ul>
                          </div>
                        </section>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab2">
                  <ul class="list-group m-b-none m list-group-lg list-group-sp">
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">3 minuts ago</small>
                        <strong class="block">Drew Wllon</strong>
                        <small>Wellcome and play this web application template ... </small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">1 hour ago</small>
                        <strong class="block">Jonathan George</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">2 hours ago</small>
                        <strong class="block">Josh Long</strong>
                        <small>Vestibulum ullamcorper sodales nisi nec...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">1 day ago</small>
                        <strong class="block">Jack Dorsty</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">3 days ago</small>
                        <strong class="block">Morgen Kntooh</strong>
                        <small>Mobile first web app for startup...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">Jun 21</small>
                        <strong class="block">Yoha Omish</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">May 10</small>
                        <strong class="block">Gole Lido</strong>
                        <small>Vestibulum ullamcorper sodales nisi nec...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">Jan 2</small>
                        <strong class="block">Jonthan Snow</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item" href="#email-content" data-toggle="class:show">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">3 minuts ago</small>
                        <strong class="block">Drew Wllon</strong>
                        <small>Vestibulum ullamcorper sodales nisi nec sodales nisi nec sodales nisi nec...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">1 hour ago</small>
                        <strong class="block">Jonathan George</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">2 hours ago</small>
                        <strong class="block">Josh Long</strong>
                        <small>Vestibulum ullamcorper sodales nisi nec...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">1 day ago</small>
                        <strong class="block">Jack Dorsty</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">3 days ago</small>
                        <strong class="block">Morgen Kntooh</strong>
                        <small>Mobile first web app for startup...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">Jun 21</small>
                        <strong class="block">Yoha Omish</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">May 10</small>
                        <strong class="block">Gole Lido</strong>
                        <small>Vestibulum ullamcorper sodales nisi nec...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">Jan 2</small>
                        <strong class="block">Jonthan Snow</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item" href="#email-content" data-toggle="class:show">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">3 minuts ago</small>
                        <strong class="block">Drew Wllon</strong>
                        <small>Vestibulum ullamcorper sodales nisi nec sodales nisi nec sodales nisi nec...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">1 hour ago</small>
                        <strong class="block">Jonathan George</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">2 hours ago</small>
                        <strong class="block">Josh Long</strong>
                        <small>Vestibulum ullamcorper sodales nisi nec...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar_default.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">1 day ago</small>
                        <strong class="block">Jack Dorsty</strong>
                        <small>Morbi nec nunc condimentum...</small>
                      </a>
                    </li>
                    <li class="list-group-item">
                      <a href="#" class="thumb-sm pull-left m-r-sm">
                        <img src="images/avatar.jpg" class="img-circle">
                      </a>
                      <a href="#" class="clear">
                        <small class="pull-right">3 days ago</small>
                        <strong class="block">Morgen Kntooh</strong>
                        <small>Mobile first web app for startup...</small>
                      </a>
                    </li>
                  </ul>
                </div>                            
                <div class="tab-pane" id="tab3">
                  <div class="text-center wrapper">
                    <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                  </div>
                </div>
              </div>
            </aside>
            <aside class="b-l aside-lg bg-light">
              <section class="wrapper">
                <div class="text-center m-b">
                  <div class="inline">
                    <div class="easypiechart" data-percent="65" data-line-width="25" data-track-color="#eee" data-bar-color="#afcf6f" data-scale-color="#ddd" data-loop="false" data-size="180">
                      <span class="h2">60</span>%
                      <div class="easypie-text">Processing</div>
                    </div>
                  </div>
                </div>
                <div class="panel-group m-b" id="accordion2">
                  <div class="panel">
                    <div class="panel-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        Collapsible Group Item #1
                      </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse in">
                      <div class="panel-body text-sm">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt.
                      </div>
                    </div>
                  </div>
                  <div class="panel">
                    <div class="panel-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                        Collapsible Group Item #2
                      </a>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="panel-body text-sm">
                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel">
                    <div class="panel-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                        Collapsible Group Item #3
                      </a>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="panel-body text-sm">
                        Sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                      </div>
                    </div>
                  </div>
                </div>
              </section>                      
            </aside>
          </section> -->
        </section>
      </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
    <!-- /.vbox -->