<?php $filebasename = basename($_SERVER['REQUEST_URI']); ?>
<div data-position="right"  class="cl-sidebar">
            <div class="cl-toggle"><i class="fa fa-bars"></i></div>
            <div class="cl-navblock">
               <div class="menu-space">
                  <div class="content nano-content">
                     
                     <ul class="cl-vnavigation">
                      <li><a href="<?=ADMINPATH?>/dashboard/"><i class="fa fa-home"></i><span>Home</span></a></li>
                      
              <?php 
				$sqlMenu = "select * from menu where menu_type=1 and status=1 order by order_status";
				$rowMenu = $db_query->runQuery($sqlMenu);
				foreach($rowMenu as $menuItem){ 
				  $numCount = $db_query->fetch_object("select count(*) c from menu where sub_menu_id='$menuItem[menu_id]' and status=1 and menu_type=2");
	?> 
    
                     <li>
                           <a href="<?=ADMINPATH?>/<?=$menuItem[link]?>"><i class="fa <?=$menuItem[icon]?>"></i><span><?=$menuItem[name]?></span></a>
                           
             <?php $sql_sub = "select * from menu where sub_menu_id='$menuItem[menu_id]' and status=1 and menu_type=2 order by menu_id";
				   $row_sub = $db_query->runQuery($sql_sub);
				   if(!empty($row_sub)) { 
	          ?>
                           <ul class="sub-menu">
                           <?php foreach($row_sub as $sub_menu_item) { ?> 
                              <li <?php if($filebasename==$sub_menu_item[link]) { ?> class="active" <?php } ?>><a href="<?=ADMINPATH?>/<?=$sub_menu_item[link]?>"><?=$sub_menu_item[name]?></a></li>
                            <?php } ?>
                           </ul>
                           
                            <?php } ?>  
                            
                        </li>
                        
                        
                  <?php } ?>      
                        
                      
                     </ul>
                  </div>
               </div>
               <div class="search-field collapse-button">
              <!-- <input type="text" placeholder="Search..." class="form-control search">-->
              <a href="<?=ADMINPATH?>/logout/">
              <i class="fa  fa-sign-out">Sign Out</i></a>
              <button id="sidebar-collapse" class="btn btn-default"><i class="fa fa-angle-left"></i></button></div>
            </div>
         </div>