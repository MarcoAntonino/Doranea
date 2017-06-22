<!-- Sidebar -->
            <div id="wrapper" class="active">
              
              <div id="sidebar-wrapper">
                <!-- filtri -->
                <div id="sidebar">
                  <p>Filtri</p>
                  <ul class="sidebar-nav">     
                    <li>
                      <legend>Sesso</legend>
                      <input type="radio" name="sex" value="M"/> Maschi <br /> 
                      <input type="radio" name="sex" value="F"/> Femmine  <br />
					  <input type="radio" name="sex" value="T" checked="checked"/> Tutti  <br />
                    </li>
                    <li>
                      <br/>
                      <legend>Anno</legend>
                      <input id="ex16a" type="text"/><br/>
                    </li>
                    <li>
                      <br/>
                      <legend>Provenienza</legend>
                      <?php
                        echo makeFromInsert();
                      ?>
                      <br/>
                      <h6 id="tutti"><em>Seleziona/deseleziona tutti</em></h6>
                    </li>
                  </ul>
                  <br/>
                  <span class="appfiltri">
                    <button class="btn btn-success" name="aggiorna" onClick="aggiornaMappa();">Aggiorna mappa</button>
                  </span>
                </div>
                <!-- end filtri -->
                <div id="sidebar_menu">
                  <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                      <a id="menu-toggle" href="#">
                        <span id="main_icon" class="glyphicon glyphicon-filter"></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
<!-- end sidebar -->