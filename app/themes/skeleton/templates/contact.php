<?php 

/**
* @package Jabali 
* @subpackage Skeleton
* @author Mauko Maunde
* @link https://jabalicms.org/themes/skeleton
* @since 0.1
**/

?>

    <main>
      <title><?php showOption( 'name' ); ?></title>
	  <!-- Primary Page Layout
	  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
	  <div class="container">
	    <div class="row">
		    <div class="one column"></div>
		    <div class="eleven column">
		    	<form>
				  <div class="row">
				    <div class="six columns">
				      <label for="exampleEmailInput">Your email</label>
				      <input class="u-full-width" type="email" placeholder="test@mailbox.com" id="exampleEmailInput">
				    </div>
				    <div class="six columns">
				      <label for="exampleRecipientInput">Reason for contacting</label>
				      <select class="u-full-width" id="exampleRecipientInput">
				        <option value="Option 1">Questions</option>
				        <option value="Option 2">Admiration</option>
				        <option value="Option 3">Can I get your number?</option>
				      </select>
				    </div>
				  </div>
				  <label for="exampleMessage">Message</label>
				  <textarea class="u-full-width" placeholder="Hi Dave …" id="exampleMessage"></textarea>
				  <label class="example-send-yourself-copy">
				    <input type="checkbox">
				    <span class="label-body">Send a copy to yourself</span>
				  </label>
				  <input class="button-primary" type="submit" value="Submit">
				</form>
		    </div>
		    <div class="one column"></div>
	  	</div>
		</div>
    </main>

    