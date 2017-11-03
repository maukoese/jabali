<?php 
/**
* @package Jabali Framework
* @subpackage App Admin Dashboard
* @link https://docs.jabalicms.org/dashboard/
* @author Mauko Maunde
* @since 0.17.04
**/
session_start();
require_once( '../init.php' );
require_once( 'header.php' ); ?>
<title>Dashboard - <?php showOption( 'name' ); ?></title>
  <div class="mdl-grid">
            <div class="demo-charts <?primaryColor(); ?> mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
              <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell-3-col mdl-cell--3-col-desktop">
                <use xlink:href="#piechart" mask="url(#piemask)">
                <text x="0.5" y="0.5" font-family="Roboto" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan font-size="0.2" dy="-0.07">%</tspan></text>
              </svg>
              <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--3-col mdl-cell--3-col-desktop">
                <use xlink:href="#piechart" mask="url(#piemask)">
                <text x="0.5" y="0.5" font-family="Roboto" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan dy="-0.07" font-size="0.2">%</tspan></text>
              </svg>
              <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--3-col mdl-cell--3-col-desktop">
                <use xlink:href="#piechart" mask="url(#piemask)">
                <text x="0.5" y="0.5" font-family="Roboto" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan dy="-0.07" font-size="0.2">%</tspan></text>
              </svg>
            </div>
            <div class="demo-graphs mdl-shadow--2dp <?primaryColor(); ?> mdl-cell mdl-cell--8-col">
              <svg fill="currentColor" viewBox="0 0 500 250" class="demo-graph">
                <use xlink:href="#chart">
              </svg>
              <svg fill="currentColor" viewBox="0 0 500 250" class="demo-graph">
                <use xlink:href="#chart">
              </svg>
            </div>
            <div class="demo-cards mdl-cell mdl-cell--4-col">
              <div class="demo-options mdl-card <?primaryColor(); ?> mdl-shadow--2dp">
                <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
                  <h3>View options</h3>
                  <ul>
                    <li>
                      <label for="chkbox1" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                        <input type="checkbox" id="chkbox1" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Click per object</span>
                      </label>
                    </li>
                    <li>
                      <label for="chkbox2" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                        <input type="checkbox" id="chkbox2" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Views per object</span>
                      </label>
                    </li>
                    <li>
                      <label for="chkbox3" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                        <input type="checkbox" id="chkbox3" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Objects selected</span>
                      </label>
                    </li>
                    <li>
                      <label for="chkbox4" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                        <input type="checkbox" id="chkbox4" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Objects viewed</span>
                      </label>
                    </li>
                  </ul>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                  <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-grey-50">Change location</a>
                  <div class="mdl-layout-spacer"></div>
                  <i class="material-icons">location_on</i>
                </div>
              </div>
            </div>
  </div>

      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="position: fixed; left: -1000px; height: -1000px;">
        <defs>
          <mask id="piemask" maskContentUnits="objectBoundingBox">
            <circle cx=0.5 cy=0.5 r=0.49 fill="white">
            <circle cx=0.5 cy=0.5 r=0.40 fill="black">
          </mask>
          <g id="piechart">
            <circle cx=0.5 cy=0.5 r=0.5>
            <path d="M 0.5 0.5 0.5 0 A 0.5 0.5 0 0 1 0.95 0.28 z" stroke="none" fill="rgba(255, 255, 255, 0.75)">
          </g>
        </defs>
      </svg>
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 250" style="position: fixed; left: -1000px; height: -1000px;">
        <defs>
          <g id="chart">
            <g id="Gridlines">
              <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="27.3" x2="468.3" y2="27.3">
              <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="66.7" x2="468.3" y2="66.7">
              <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="105.3" x2="468.3" y2="105.3">
              <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="144.7" x2="468.3" y2="144.7">
              <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="184.3" x2="468.3" y2="184.3">
            </g>
            <g id="Numbers">
              <text transform="matrix(1 0 0 1 485 29.3333)" fill="#888888" font-family="'Roboto'" font-size="9">500</text>
              <text transform="matrix(1 0 0 1 485 69)" fill="#888888" font-family="'Roboto'" font-size="9">400</text>
              <text transform="matrix(1 0 0 1 485 109.3333)" fill="#888888" font-family="'Roboto'" font-size="9">300</text>
              <text transform="matrix(1 0 0 1 485 149)" fill="#888888" font-family="'Roboto'" font-size="9">200</text>
              <text transform="matrix(1 0 0 1 485 188.3333)" fill="#888888" font-family="'Roboto'" font-size="9">100</text>
              <text transform="matrix(1 0 0 1 0 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">1</text>
              <text transform="matrix(1 0 0 1 78 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">2</text>
              <text transform="matrix(1 0 0 1 154.6667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">3</text>
              <text transform="matrix(1 0 0 1 232.1667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">4</text>
              <text transform="matrix(1 0 0 1 309 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">5</text>
              <text transform="matrix(1 0 0 1 386.6667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">6</text>
              <text transform="matrix(1 0 0 1 464.3333 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">7</text>
            </g>
            <g id="Layer_5">
              <polygon opacity="0.36" stroke-miterlimit="10" points="0,223.3 48,138.5 154.7,169 211,88.5
              294.5,80.5 380,165.2 437,75.5 469.5,223.3   ">
            </g>
            <g id="Layer_4">
              <polygon stroke-miterlimit="10" points="469.3,222.7 1,222.7 48.7,166.7 155.7,188.3 212,132.7
              296.7,128 380.7,184.3 436.7,125   ">
            </g>
          </g>
        </defs>
      </svg><?php 
include './footer.php'; ?>