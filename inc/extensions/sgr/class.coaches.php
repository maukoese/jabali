<?php 

class _hCoaches extends _hResources {

  function getCoaches() { ?>
    <title>All Coaches [ <?php showOption( 'name' ); ?> ]</title><?php 
    $coaches = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources LEFT JOIN hcoaches ON hcoaches.h_code = hresources.h_code WHERE h_type = 'coach'" );
    if ( $coaches -> num_rows > 0) {
      while( $row = mysqli_fetch_assoc( $coaches) ) {
        $coaches_array[] = $row;
      }
    }

    if ( !empty( $coaches_array) ) { 
      foreach( $coaches_array as $key=>$value){ ?>
      <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card-media">
          <img src="<?php echo $coaches_array[$key]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
        </div>
        <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $coaches_array[$key]["h_code"]; ?>">
          <div class="mdl-card__title mdl-card--expand">
              <div class="mdl-card__title-text">
                <?php echo $coaches_array[$key]["h_alias"]; ?>
              </div>
              <div class="mdl-layout-spacer"></div>
                <div class="mdl-card__subtitle-text">
            <?php echo "KSh ".$coaches_array[$key]["h_price"]; ?>
              
            </div>
            </div>
          <div class="mdl-card__supporting-text">
            <div class="input-field inline">
              <input type="number" name="quantity" value="1" size="2" />
            </div>
            <div class="input-field inline" style="padding-left: 10px;">
              <button type="submit" class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright">
              <i class="material-icons">add_shopping_cart</i></button>
            </div>
          </div>
          <span style="padding: 20px;">
          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">thumb_up</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">comment</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">image</i></a>

          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon alignright" id="prbtn">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-color--<?php primaryColor(); ?>" for="prtbtn">
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                </ul>
              </span>
              
          <div class="mdl-card__menu">
          <a href="?fav=<?php echo $coaches_array[$key]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
          </div>
        </form>
      </div><?php 
      }
    }
  }

  function getCoachesClass( $class ) { ?>
    <title><?php _show_( ucwords( $class ) ); ?> Coaches [ <?php showOption( 'name' ); ?> ]</title><?php 
    $coaches = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources LEFT JOIN hcoaches ON hcoaches.h_code = hresources.h_code WHERE hresources.h_type = 'coach' AND hcoaches.h_type = '".$class."'" );
    if ( $coaches -> num_rows > 0) {
      while( $row = mysqli_fetch_assoc( $coaches) ) {
        $coaches_array[] = $row;
      }
    } else {
        print_r('<span class="mdl-color--red">Not Found</span>');
    }

    if ( !empty( $coaches_array) ) { 
      foreach( $coaches_array as $key=>$value){ ?>
      <div class="mdl-cell mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card-media">
          <img src="<?php echo $coaches_array[$key]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
        </div>
        <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $coaches_array[$key]["h_code"]; ?>">
          <div class="mdl-card__title mdl-card--expand">
              <div class="mdl-card__title-text">
                <?php echo $coaches_array[$key]["h_alias"]; ?>
              </div>
              <div class="mdl-layout-spacer"></div>
                <div class="mdl-card__subtitle-text">
            <?php echo "KSh ".$coaches_array[$key]["h_price"]; ?>
              
            </div>
            </div>
          <div class="mdl-card__supporting-text">
            <div class="input-field inline">
              <input type="number" name="quantity" value="1" size="2" />
            </div>
            <div class="input-field inline" style="padding-left: 10px;">
              <button type="submit" class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright">
              <i class="material-icons">add_shopping_cart</i></button>
            </div>
          </div>
          <div class="mdl-card__menu">
          <a href="?fav=<?php echo $coaches_array[$key]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
          </div>
        </form>
      </div><?php 
      }
    }
  }

  function getCoach( $code) {
    $coach = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources LEFT JOIN hcoaches ON hcoaches.h_code = hresources.h_code WHERE hresources.h_code='". $_GET["view"] ."'" );
    if ( $coach -> num_rows > 0) { 
      while( $coach_array = mysqli_fetch_assoc( $coach) ) {
        $coach_deets[] = $coach_array;?>
    <title><?php _show_( $coach_deets[0]['h_alias'] ); ?> [ <?php showOption( 'name' ); ?> ]</title><?php 
      }
    } ?>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
      <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $coach_deets[0]["h_code"]; ?>">
        <div class="mdl-card__title mdl-card--expand">
            <div class="mdl-card__title-text">
              <?php echo $coach_deets[0]["h_alias"]; ?>
            </div>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
            </div>
        </div>

        <div class="mdl-card__supporting-text mdl-grid">
          <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp mdl-grid mdl-color--amber">
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="mdi mdi-human-child mdi-24px mdl-badge mdl-badge--overlap"></a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
          </div>
          <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp mdl-grid mdl-color--amber">
            
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
            <div class="mdl-cell mdl-cell--6-col mdl-card mdl-shadow--2dp">
              <center><h5><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">event_seat</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">child_care</a><a  href="?view=x&buy=add&seat=y" class="material-icons mdl-badge mdl-badge--overlap">face</a></h5></center>
            </div>
          </div>
        </div>
            
        <div class="mdl-card__menu">
        <span class="mdl-button"><?php echo "KSh ".$coach_deets[0]["h_price"]; ?></span>
        </div>
      </form>
    </div>

    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
      <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $coaches_array[$key]["h_code"]; ?>">
        <div class="mdl-card__title mdl-card--expand">
            <div class="mdl-card__title-text">
              Booking T&Cs
            </div>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
            </div>
        </div>

        <div class="mdl-card__supporting-text">
        <article id="post-1652" class="">

        <p>TRAVEL DAILY (MONDAY – SUNDAY) BETWEEN MOMBASA AND NAIROBI</p>

<ul class="collapsible popout" data-collapsible="accordion">
<li>
  <div class="collapsible-header">TICKETING</div>
  <div class="collapsible-body">
  <table style="width: 98%;" class="mdl-table mdl-color--<?php primaryColor(); ?>">
  <tbody>
  <tr>
  <td><strong>&nbsp;SCHEDULE:</strong></td>
  <td><strong>DEPARTURE</strong></td>
  <td><strong>ARRIVAL</strong></td>
  </tr>
  <tr>
  <td>MOMBASA – NAIROBI</td>
  <td>09:00&nbsp;AM</td>
  <td>1:30 PM</td>
  </tr>
  <tr>
  <td>NAIROBI-MOMBASA</td>
  <td>09:00&nbsp;AM</td>
  <td>1:30&nbsp;PM</td>
  </tr>
  </tbody>
  </table>
  </div>
</li>
<li>
  <div class="collapsible-header">MADARAKA EXPRESS TRAIN SERVICE FARES</div>
  <div class="collapsible-body">
  <p><strong>First Class:&nbsp;</strong>&nbsp;KSH&nbsp;3,000<br>
  <strong>Economy Class:</strong> KSH &nbsp;700</p>
  <p><strong><span style="color: #f1592a;">CHILDREN</span></strong></p>
  <p><strong>Below 3 Years</strong> : &nbsp;FREE<br>
  <strong>Age between 3 – 11 Years</strong> :</p>
  <ul>
  <li><em><strong>First clas</strong>s : Ksh : &nbsp;1,500</em></li>
  <li><em><strong> Economy class</strong>&nbsp;: Ksh 350</em></li>
  </ul>
  <p><strong>Above 11 Years&nbsp;:</strong></p>
  <ul>
  <li><em><strong>First class</strong>&nbsp;: Ksh 3,000</em></li>
  <li><em><strong>Economy class</strong>&nbsp;: Ksh 700</em></li>
  </ul>
  </div>
</li>
<li>
  <div class="collapsible-header">TICKETING</div>
  <div class="collapsible-body">
  <ul>
  <li>Tickets are available at the counter at the respective termini/stations</li>
  <li>Tickets on sale between 07:00 am and 03:00 pm</li>
  <li>Pay by cash or debit/credit card</li>
  <li>Book upto three (3) days in advance</li>
  </ul>
  </div>
</li>

<li>
  <div class="collapsible-header">LUGGAGE</div>
  <div class="collapsible-body">
  <p><strong>Weight:</strong> Not exceeding 30 kilograms</p>
  <p><strong>Size:</strong> Should not measure more than 1.6 metres in height, width and depth</p>
  </div>
</li>
<li>
  <div class="collapsible-header">Terms &amp; Conditions</div>
  <div class="collapsible-body">
  <p>Travelers are requested to purchase tickets at the ticket windows in the ticket office at stations</p>
  <p>When at the ticket office:</p>
  <ul>
  <li>Please pay attention to the display screen at the ticket windows</li>
  <li>Please prepare ticket fee in advance for quick service</li>
  <li>Tell the Attendant your travel date, train number, dispatching (departure) station, destination station, preferred class, preferred seat number and ticket type</li>
  <li>Please check the ticket information and confirm you have been given the correct balance after purchasing the ticket</li>
  <li>Tell the ticket seller if you notice any mistake before leaving the counter</li>
  </ul>
  <p>The Railway station will not accept any children who are traveling alone</p>
  <p>Children between 3-11 years travelling with adults will get a 50 per cent discount</p>
  <p>Children over 11 years old must pay the full ticket price</p>
  <p>Each adult passenger can bring 1 child of 3 years or below. The child will travel free of charge.</p>
  <p>In case an adult passenger is travelling with two or more children, the other children must pay half the ticket price</p>
  <p>Cases where a passenger is travelling with twins, triplets or quadruplets, the children shall be deemed as 1 child provided ther is proof of birth e.g a birth certificate. One is thus encouraged to carry all relevant certificates and present them at the counter in such cases. For cases where proof of birth is not available, the child will be required to pay the full ticket amount.</p>
  <p>In cases where a passenger looses his/her ticket, he/she will be required to buy another ticket in order to travel.</p>
  <p>If a passenger looses his/her ticket while in transit, the passenger will be expected to buy another ticket at the destination station I order to exit the station,</p>
  <p>Cases where a passenger misses to catch the train due to personal reason, the following refund procedure shall be observed:</p>
  <ul>
  <li>If the passenger notifies the station attendants before the train departs, the operator shall deduct 20 per cent of the ticket fee (refund fee)</li>
  <li>Refunds will not be issued after the journey has commenced, at Intermediate or destination stations.</li>
  <li>The ticket is a valuable train taking proof so please keep them properly. Requests for a refund will be rejected in cases where the tickets are damaged (unrecognizable).</li>
  </ul>
  </div>
</li>
</ul>
    </article>
        </div>
            
        <div class="mdl-card__menu">
        </div>
      </form>
    </div<?php 
    }
} ?>

