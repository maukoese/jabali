<?php include './header.php'; ?>
<style>
	/*Vertical Tabs*/
.vertical-mdl-tabs {
    margin-top: 30px;
}
.vertical-mdl-tabs .mdl-tabs__tab-bar {
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column;
    padding-bottom: 35px;
    height: inherit;
    border-bottom: none;
    border-right: 1px solid rgba(10, 11, 49, 0.20);
    color: <?php primaryColor( $_SESSION['myCode']); ?>
}

.vertical-mdl-tabs .mdl-tabs__tab {
    width: 100%;
    height: 35px;
    line-height: 35px;
    box-sizing: border-box;
    letter-spacing: 2px;
}

.vertical-mdl-tabs.mdl-tabs.is-upgraded a.mdl-tabs__tab.is-active {
    border-right: 2px solid #ED462F;
}
.vertical-mdl-tabs.mdl-tabs.is-upgraded .mdl-tabs__tab.is-active:after {
    content: inherit;
    height: 0;
}

.vertical-mdl-tabs.mdl-tabs.is-upgraded .mdl-tabs__panel.is-active, .mdl-tabs__panel {
    padding: 0 30px;
}

.vertical-mdl-tabs.mdl-tabs .mdl-tabs__tab {
    text-align: left;
}
</style>
<div class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
  <div class="mdl-grid mdl-grid--no-spacing">
    <div class="mdl-cell mdl-cell--1-col">
	      <div class="mdl-tabs__tab-bar ">
	         <a href="#tab1-panel" class="mdl-tabs__tab is-active">
	      	     <span class="hollow-circle"></span>
	      	      <i class="material-icons mdl-list__item-icon">message</i>
	         </a>
	         <a href="#tab2-panel" class="mdl-tabs__tab">
	      	      <span class="hollow-circle"></span>
	      	      <i class="material-icons mdl-list__item-icon">question_answer</i>
	          </a>
	          <a href="#tab3-panel" class="mdl-tabs__tab">
	      	      <span class="hollow-circle"></span>
	            	<i class="material-icons mdl-list__item-icon">phone</i>
	          </a>
	          <a href="#tab3-panel" class="mdl-tabs__tab">
	      	      <span class="hollow-circle"></span>
	          		<i class="material-icons mdl-list__item-icon"></i></a>
	          </a>
	          <a href="#tab3-panel" class="mdl-tabs__tab">
	      	      <span class="hollow-circle"></span>
	          		<i class="material-icons mdl-list__item-icon"></i></a>
	          </a>
	          <a href="#tab3-panel" class="mdl-tabs__tab">
	      	      <span class="hollow-circle"></span>
	          		<i class="material-icons mdl-list__item-icon"></i></a>
	          </a>
	          <a href="#tab3-panel" class="mdl-tabs__tab">
	      	      <span class="hollow-circle"></span>
	          		<i class="material-icons mdl-list__item-icon"></i></a>
	          </a>
	          <a href="#tab3-panel" class="mdl-tabs__tab">
	      	      <span class="hollow-circle"></span>
	          		<i class="material-icons mdl-list__item-icon">more_horiz</i></a>
	          </a>
	     </div>
	   </div>
	   <div class="mdl-cell mdl-cell--11-col">
	      	<div class="mdl-tabs__panel is-active" id="tab1-panel">
		         Content 1
	      	</div>
	      	<div class="mdl-tabs__panel" id="tab2-panel">
		         Content 2
			</div>
			<div class="mdl-tabs__panel" id="tab3-panel">
		          Content 3
	      	</div>
	    </div>
  </div>
<?php include './footer.php';
?>