<?php
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/

include 'header.php'; ?>
<title>My Portfolio [ <?php getOption('name'); ?> ]</title>
<style>
.tile { 
    -webkit-transform: scale(0);
    transform: scale(0);
    -webkit-transition: all 350ms ease;
    transition: all 350ms ease;

}
.tile:hover { 

}

.scale-anm {
  transform: scale(1);
}


p{ 
  padding:10px; 
  border-bottom: 1px #ccc dotted; 
  text-decoration: none; 
  font-family: lato; 
  text-transform:uppercase; 
  font-size: 12px; 
  color: #333; 
  display:block; 
  float:left;
}

p:hover { 
  cursor:pointer; 
  background: #333; 
  color:#eee; }

.tile img {
    max-width: 100%;
    width: 100%;
    height: auto;
    margin-bottom: 1rem;
  
}

.btn {
    font-size: 1rem;
    font-weight: normal;
    text-decoration: none;
    cursor: pointer;
    display: inline-block;
    line-height: normal;
    padding: .5rem 1rem;
    margin: 0;
    height: auto;
    vertical-align: middle;
    -webkit-appearance: none;
}

.btn:hover {
  text-decoration: none;
}

.btn:focus {
  outline: none;
  border-color: var(--darken-2);
  box-shadow: 0 0 0 3px var(--darken-3);
}

::-moz-focus-inner {
  border: 0;
  padding: 0;
}
</style>
<script>
var options = {
        valueNames: ['material', 'quantity', 'price']
    }
  , documentTable = new List('mdl-table', options)
  ;


$($('th.sort')[0]).trigger('click', function () {
  console.log('clicked');
});

$('input.search').on('keyup', function (e) {
  if (e.keyCode === 27) {
    $(e.currentTarget).val('');
    documentTable.search('');
  }
});
</script>
<div class="mdl-grid">
<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
<div class="toolbar mb2 mt2 mdl-card__title"><br><center>
  <button class="btn mdl-button mdl-color--teal fil-cat" href="" data-rel="all">All</button>
  <button class="btn mdl-button mdl-color--teal  fil-cat" data-rel="web">Websites</button>
  <button class="btn mdl-button mdl-color--teal  fil-cat" data-rel="flyers">Flyers</button>
  <button class="btn mdl-button mdl-color--teal  fil-cat" data-rel="bcards">Web Apps</button>
  <button class="btn mdl-button mdl-color--teal  fil-cat" data-rel="bcards">Android Apps</button>
  <button class="btn mdl-button mdl-color--teal  fil-cat" data-rel="bcards">Web/Email Hosting</button>
  <button class="btn mdl-button mdl-color--teal  fil-cat" data-rel="bcards">Graphic Design</button></center>
</div>

<div class="mdl-card__supporting-text mdl-card--expand">   
<div id="portfolio" class="mdl-grid">
  <div class="mdl-cell tile scale-anm web all">
        <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/2-mon_1092-300x234.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm bcards all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/jti-icons_08-300x172.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm web all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/emi_haze-300x201.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm web all">
            <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/codystretch-300x270.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm flyers all">
        <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97190&w=350&h=190" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm bcards all">
            <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm flyers all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/jti-icons_08-300x172.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm flyers all">
    <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/transmission_01-300x300.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm web all">
        <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm flyers all">
           <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" /> 
  </div>
  <div class="mdl-cell tile scale-anm web all">
        <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/the-ninetys-brand_02-300x300.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm bcards all">
            <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/15-dia_1092-1-300x300.jpg" alt="" />
  </div>
  <div class="mdl-cell tile scale-anm web all">
       <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97190&w=350&h=190" alt="" /> 
  </div>
  <div class="mdl-cell tile scale-anm bcards all">
          <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/emi_haze-300x201.jpg" alt="" />  
  </div>
  <div class="mdl-cell tile scale-anm web all">
            <img src="http://demo.themerain.com/charm/wp-content/uploads/2015/04/transmission_01-300x300.jpg" alt="" />
  </div> 
  <div class="mdl-cell tile scale-anm web all">
      <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97190&w=350&h=190" alt="" />  
  </div> 
  <div class="mdl-cell tile scale-anm bcards all">     
            <img src="https://placeholdit.imgix.net/~text?txtsize=19&txt=200%C3%97290&w=200&h=290" alt="" />
  </div>
</div>

</div>

</div>
<div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp ">
  <div class="mdl-card__title">
  <i class="material-icons">work</i>
    <span class="mdl-button">My Portfolio</span>
  </div>
  <div class="mdl-card__supporting-text mdl-card--expand">
    Random details here.
  </div>
</div>  
<?php 
include 'footer.php';
?>