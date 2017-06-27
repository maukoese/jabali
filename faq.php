<?php include 'header.php'; ?>
<title>Frequently Asked Questions [ <?php showOption( 'name' ); ?> ]</title>
  <?php 
    $getfaqs = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hfaqs" );
    if ( $getfaqs ) { ?>
      <div class="mdl-grid ">
        <div class="mdl-card mdl-cell mdl-cell--12-col mdl-color--<?php primaryColor(); ?>">
          <ul class="collapsible popout" data-collapsible="accordion">
            <li>
<div class="collapsible-header">
<i class="material-icons">help</i>Ask for Help</div>
              <div class="collapsible-body">

              <?php $hForm -> faqForm(); ?>
              </div>
            </li><?php 
            while ( $faq = mysqli_fetch_assoc( $getfaqs) ) { ?>
              <li>
<div class="collapsible-header">
<i class="material-icons">help_outline</i>'.$faq['h_alias'].'</div>
                <div class="collapsible-body">
<span>'.$faq['h_description'].'</span></div>
              </li><?php 
            } ?>
<li><div class="collapsible-header">1. What is SGR and why SGR?</div>
<div class="collapsible-body" >
The Standard Gauge Railway (SGR) is a flagship project identified by the Government of Kenya as a transport component aimed at delivering Vision 2030 making Kenya a middle income country by 2030. The railway line will be of Standard Gauge technology. It will have uniform design specifications which will permit seamless operation across the borders of the countries with each country responsible for construction of the section that lies within its borders.</div>
</li>
<li>
<div class="collapsible-header">
2. Which is the route for the SGR project?</div>
</li>


<div class="collapsible-body">
The Government of the Republic of Kenya has identified two corridors for the development of the modern, high-capacity Standard Gauge Railway (SGR) transport system for both freight and passengers.<p></p>
<p><strong>Phase I {472 km}</strong></p>
<ul>
<li>Mombasa – Nairobi</li>
</ul>
<p><strong>Phase 2 {487km} </strong></p>
<ul>
<li>Nairobi – Kisumu – Malaba is divided into three sub-phases</li>
</ul>
<p><strong>Phase 2A {120 km}</strong></p>
<ul>
<li>Nairobi – Naivasha</li>
</ul>
<p><strong>Phase 2B {262 km}</strong></p>
<ul>
<li>Naivasha – Narok – Bomet – Ahero – Kisumu (including a new high capacity- port at Kisumu)</li>
</ul>
<p><strong>Phase 2C {107 km}</strong></p>
<ul>
<li>Kisumu – Yala – Mumias – Malaba</li>
</ul>
<ol start="2">
<li><strong> LAPSSET Corridor</strong></li>
</ol>
<ul>
<li>Lamu – Isiolo – Nakodok (bordering South Sudan) = <strong>1,350 km</strong></li>
<li>Nairobi – Isiolo – Moyale (bordering Ethiopia) =<strong> 700 km </strong></li></ul></div>
</li>
<li>
<div class="collapsible-header">3. Who are the financiers of this project? 
</div>
<div class="collapsible-body">
The project is financed by the Export Import (EXIM) bank of China and the Government of Kenya.</div>
</li>
<li>
<div class="collapsible-header">
4.What are the elements of the Project?
</div>

<div class="collapsible-body">
<strong>PHASE I</strong><p></p>
<ul>
<li>Build single line Standard Gauge Railway connecting Mombasa to Nairobi</li>
</ul>
<ul>
<li>Build state of the art stations at Mombasa and Nairobi. This will incorporate freight exchange and passenger centers’.</li>
</ul>
<ul>
<li>The line will have one port station, two major passenger stations in Mombasa and Nairobi, 7 passenger intermediate passenger stations at Mariakani, Miasenyi, Voi, Mtito Andei, Kibwezi, Emali and Athi River and 23 crossing stations.</li>
<li>98 Bridges covering 29 Km of the railway line will be built and used to span rivers, valleys, roads and areas where the SGR crosses the existing Metre Gauge Railway</li>
<li>Nine Wildlife Animal Crossing Corridors have been erected within Tsavo East and Tsavo West National parks for wildlife to pass under the SGR line. The crossing corridors are over 7 metres high and at least 70 meters wide.</li>
</ul>
<p><strong>PHASE II: Nairobi – Naivasha Features</strong></p>
<p>The project’s design incorporates super major long bridges covering 23.96 kilometres</p>
<p><strong>Super major long bridges</strong></p>
<p>Nine super long bridges will be constructed along the Nairobi – Naivasha section of the SGR project.</p>
<p>A 6.7 super major bridge will run across the expanse of the Nairobi National Park. Three other super long bridges will measure over 1 kilometer.</p>
<p><strong>Tall Bridges</strong></p>
<p>The complex terrain along the Nairobi – Naivasha section will be connected through tall bridges with the tallest rising 58 metres high at DK119+727</p>
<p><strong>Tunnels</strong></p>
<p>4 tunnels will be constructed along the Nairobi –Naivasha section of the project covering 7.756 kilometres with the longest tunnel spanning 4.5 kilometres</p>
<table>
<tbody>
<tr>
<td width="79">Tunnel</td>
<td width="120">Entrance Chainage</td>
<td width="108">Exit Chainage</td>
<td width="171">Length in metres</td>
</tr>
<tr>
<td width="79">Tunnel 1</td>
<td width="120">DK34+826</td>
<td width="108">DK39+333</td>
<td width="171">4507</td>
</tr>
<tr>
<td width="79">Tunnel 2</td>
<td width="120">DK43+455</td>
<td width="108">DK43+920</td>
<td width="171">465</td>
</tr>
<tr>
<td width="79">Tunnel 3</td>
<td width="120">DK46+390</td>
<td width="108">DK47+500</td>
<td width="171">1110</td>
</tr>
<tr>
<td width="79">Tunnel 4</td>
<td width="120">DK53+610</td>
<td width="108">DK55+362</td>
<td width="171">1752</td>
</tr>
</tbody>
</table>
<p><strong>Special subgrade</strong></p>
<p>The project’s design will incorporate construction of a special subgrade through Ngong Hills area and the Great Rift Valley covering 87.98 kilometres due to the complex terrain. This will entail large amounts of high backfilling, deep cutting and construction of slab-pile wall or gravity retaining walls.</p></div>
</li>
<li>
<div class="collapsible-header">
5.What will the SGR project deliver? 
</div>

<div class="collapsible-body">
<em>Efficient railway transport</em> for both passengers and goods catering for the transport demand in the corridor<p></p>
<ul>
<li><em>Decongestion at the Port of Mombasa</em>. The increased capacity of land transport infrastructure will meet the existing and future transport demand at the Port resulting in high freight volumes transported to and from the port.</li>
<li><em>Low Production costs</em>. The SGR Project will lead to lower tariffs making the region a competitive investment destination with low production costs</li>
<li><em>Better access to markets and additional investments</em> enhancing foreign investments which will aid in exploitation of various stranded resources in the region.</li>
<li><em>Job Creation</em>. The project has created at least 19,400 direct jobs and 6,000 employed by sub- contractors.</li>
<li><em>Reduction in Environmental</em> <em>degradation</em> with less carbon emissions from trains</li>
<li><em>Reduction in wear and tear</em> of roads hence reduced road maintenance costs.</li>
</ul>
</div>
</li>
<li>
<div class="collapsible-header">
6.What will be the speed of the trains? 
</div>

<div class="collapsible-body">
Freight Trains will travel at 80Km/Hr and Passenger Trains at 120Km/Hr.</div>
</li>
<li>
<div class="collapsible-header">
7.Does compensation for land have to be monetary or there are other models of compensation for land acquired that can be explored? 
</div>

<div class="collapsible-body">
Worldwide compulsory acquisition is a standardized exercise which is governed by laws and principles which are standardized across the globe and are used any time there is an exercise like this one. Compensation is in two forms mainly, although in various cases a 3rd has emerged. Compensation is either in equivalent land in terms of land size or in terms of money worth. Compensation is either monetary, where we pay the value equivalent to the land that has been acquired. In some countries they talk about market value in other countries they talk about fair and just value, the thing is the government doesn’t want to leave the person who has lost their land in a poorer position than they found him; but compensation can also be in form of land to land where alternative land is available the government can give land equivalent its size to the one that is being acquired or equivalent in value. But there are cases where people have been given equivalent land and have also been given money, this is a situation where there is a lot of political bickering, there is a lot of resistance from the beneficiaries but the government or the entity charged with the acquisition is keen to have the project done so it is a question of ensuring that people move out and the land is obtained. So they’ll still be told okay we will give you land at a certain price maybe lesser value ,lesser size but well also give you a relocation allowance to go and settle yourself. &nbsp;[<strong>/</strong>accordion-item]<p></p>
<p>&nbsp;</p>
<p>[accordion-item title=”8.How will the acquisition of land in phase 1 be applied in phase 2? “]Unfortunately, because in the principals of land economics no two properties have the same value even if they are next to each other, even in this case no two acquisitions processes will be the same because the challenges are different. You are acquiring different parcels from the ones acquired in the first phase. You are meeting different clients from the ones you met in the first phase. But the lessons we have learnt in this first case is that there instances where you can’t determine who the owner of the land is, that does not stop the acquiring agency from doing the valuation. So they have decided to keep the money themselves and let the process of looking for the real owner, the one they shall pay, continue. That money is kept in the NLC account where it will earn interest. NLC have also learnt that there are places they cannot pay because of disputes between two people whom they know, two people have come for the same parcel .They can be members of the same family or different people, so even that one they keep aside. They have also learnt that owing to pressure from lobbyist and also owing to the fact that it is the first time for some people to have their land acquired, when one asks for details they don’t get all the details, the id, bank a/c, addresses; it is difficult. We have learnt that lesson and therefore next time, these are the 1st things we need to inform the PAPS for them to be ready with their details.</p></div>
</li>
<li>
<div class="collapsible-header">
9.How is the land acquisition process under the SGR project conducted? 
</div>

<div class="collapsible-body">
The process of land acquisition is enshrined in law using the land act of 2012, sections 1 or 7 to 102. These are borrowing from the land acquisition act that was repealed, Regulations that NLC created out of the experiences and practices they have been doing under the land acquisition act are used.<p></p>
<p>Now the procedure is, an acquiring authority being a public agency must bring their request for acquisition to NLC from their parent ministries. After that they will tell NLC, they want to have a project to acquire some land, they will also provide the list of the properties to be affected. Together with maps that show these places then they will ask NLC to verify them. NLC will send their team from the commission to go and verify those lands, they’ll find out whether, the objective of that acquisition is really beneficial to the people and whether it is really for a public purpose.</p>
<p>NLC will publish a notice of intention to acquire the land in the Kenyan gazette and also in the dailies informing the people that land is going to be acquired for purpose a, b, c, the sizes, the acreage, the exact locations.</p>
<p>Thirdly an enquiry is held, where NLC goes to the field and meets those people and explains to them the projects and how they will acquire the process until compensation is done. Evaluations are done, for the parcels, individually; the individual parcels will be valued. After the valuation they write an offer form, where they say, they are going to acquire for example 10acres; each acre is 10million, indicating the cost to be paid as 100million, the property owners either accept or reject. They sign that form. That is a big sensitization meeting, when they sign the form NLC take it and now process the payment.</p>
<p>However after NLC have done the valuation they are able to know the total cost of that project in terms of land acquisition, if they are not paying land to land they normally write to the land acquisition body to deposit the money with NLC. By the time NLC finish with the people they pay immediately, according to the constitution it has to be prompt payment.</p>
<p>That is the procedure that is followed. Now in terms of how much land is needed, so far NLC has acquired 992hctrs, that’s about 2400acres, it’s just a stretch from Mombasa to Nairobi and NLC have so far paid out 11.7billion kshs.</p></div>
</li>
<li>
<div class="collapsible-header">
10.The land compensation process is yet to be concluded. There are reports that the fishermen who have been affected at the Port of Mombasa are yet to be compensated. Why is the process taking so long? 
</div>

<div class="collapsible-body">
&nbsp;The process is taking long especially for kilometer 0-15 from 15-460 that is Athi River there are no issues. NLC have completed that part. The main reason why that happened is that from 15 to Nairobi the parcels had titles; hence less the disputes. Between 0-15 we had no titles, we had contestation about the titles, so it has taken us quite a long time first of all to review the ownership of the land to find out who is exactly the real owner, although the constitution says even the person without a title has to be paid provided you ascertain their interest, you are supposed to pay them. But in 0-15km there are parcels which were under a settlement scheme called Maganda, which already had problems with allocation, so NLC had to go through that. Some parcels of land which are historically known to the people, people have occupied them but there are other people who have titles on top, so it’s really been a difficult process which NLC underwent and managed to discern everything and the officers now know who owns what and who does not own what. The issue of the fishermen; their livelihoods are affected, compensation is in terms of the land itself sometimes NLC have to include the businesses lost, the structures which are there and also livelihoods. The fishermen have been affected because the project is going 150mtrs into the ocean from 0km to about 4km, and that 150meters is where the fish landing sites are, that is the access routes for the fishermen to have their nets, boats, and move into the ocean. That has been closed; it means there is loss of livelihoods. The reason why NLC went into the ocean is because it was thought it would lessen the burden of demolishing the structures, as opposed to if it went into the mainland. This is Changamwe area, Magongo area, Miritini area, which are heavily populated. The cost of compensation for the structures and the land would be exorbitant that’s why it was thought that since that is public land there is no compensation for the ocean, it would lessen the cost. NLC recommended to KR and the Mombasa County government to bring back that burden to the commission, because NLC have valuation methods, principles and techniques that allow them to value any type of property or any type of livelihood.</div>
</li>
<li>
<div class="collapsible-header">
11.NLC is charged with the mandate of acquiring land for public use. There have been questions of Kenya Railways disbursing funds directly to the PAPs instead of NLC doing it, how was that handled? 
</div>

<div class="collapsible-body">
&nbsp;That is a problem that occurred because NLC had no staff to do that.SGR started in 2014 and by that time NLC had only 1 accountant and 1 finance officer, due to budgetary constituents. NLC were only given 120million for that 1st year, hardly enough to pay the secretariat. The volume of work for SGR was heavy. The commission sat down with Kenya Railways because it is also allowed under the law to appoint someone else to pay for them.</div>
</li>
<li>
<div class="collapsible-header">
12.NLC/KR are blamed for failure to educate or advise beneficiaries of the compensation on financial management thus leading to other families suffering due to poor management of the money they got. Who is mandated to offer financial management and was anything done in this regard? 
</div>

<div class="collapsible-body">
&nbsp;Before the acquisition is done, there is RAP (Resettlement Action Plan).It is when an agency is conducting the resettlement action plan that they have sessions to sensitize the beneficiaries of the expected outcome of the project and need of financial management, that was done.<p></p>
<p>However this process is normally interfered with by the people, where there is land to land compensation there is no problem. But when there is land for money compensation, problems arise because the owners say, why is the implementing agency teaching us how to use our money? Your work is only to value and give us our money; you cannot teach us how to use the money. That has been the main bone of contention; ‘‘you think we are young people who do not know how to budget, economize or to use the money properly’’.</p></div>
</li>
<li>
<div class="collapsible-header">
13.There were concerns that the National Land commission was not given consideration during the process of acquisition what transpired? Was the commission consulted? 
</div>

<div class="collapsible-body">
&nbsp;Yes NLC were consulted, especially where the railway line was known to be passing through Tsavo National Park and Nairobi National Park. They are a body that is supposed to be taking care of the natural resources under the constitution, and even under the National Land Commission Act, there many clauses and provisions of the law which compel NLC to conserve the National Resources; wildlife ,animals and so on. So when they were passing through National Parks, NLC sat down with KR and KWS and came up with negotiated settlements on how to ensure that the railway line will not affect the livelihood of the animals. For example in some places they would take the bridge and leave some space below it, to allow animals to pass. That was done with the Tsavo Bridge, Tsavo area up to Makindu, Mtito wa Ndei up and Emali.<p></p>
<p>It was the subject of discussion last year when NLC were at the Nairobi National Park. NLC did that arrangement and the railway line is passing on top, in order to avoid maximum interaction with the wildlife so that there is minimum disturbance to the animals.</p></div>
</li>
<li>
<div class="collapsible-header">
14.What are the challenges faced during the land acquisition process and what are the crucial lessons learnt? 
</div>

<div class="collapsible-body">
&nbsp;The main challenges faced, first is that people have high expectations of getting money for their land promptly. KR and NLC are always bombarded with queries, questions, petitions, calls. Every time agencies are under pressure, before the process, during payment.<p></p>
<p>Secondly, the problem of people contesting over valuations figures, it’s a big challenge. Those who refuse can only be assisted by the Environmental land court which can make a decision by redoing NLCs valuation or improve the figure.</p>
<p>Thirdly, Delay in disbursement of the funds from the Railways development funds occasioned by basic issues like NLC or agency appointed to disburse the funds not having the correct name. Reconciling the list between NLC and Kenya Railways at the time when KR was paying, that payment arrangement was such that at any stage it is NLC who would authorize. KR would prepare, NLC comes and verifies with their offer forms and ensure that it is okay. That is when they would authorize payment. And even after payment, the bank would give NLC the remittance receipt so they are sure payment has been made in the same amount.</p></div>
</li>
<li>
<div class="collapsible-header">
15.What should Kenyans know about issues raised on land acquisition for SGR
</div>

<div class="collapsible-body">
&nbsp;Kenyans should know that the government of Kenya under President Uhuru Kenyatta is determined to operationalise and implement various megaprojects for this country. All these are going to be done on land, and the NLC knows very well the number of projects that are there, we would like to encourage Kenyans to allow space for the government to implement these projects because they are finally for the good of this country. It is not proper for people to demand exorbitant compensation amounts or to stop projects from going on and yet these projects are going to benefit the people. Once the resources are available there is no way the government can enter into people’s land without compensating them. Section 40 of the constitution is very clear that nobody’s land will be taken away for public purposes without that person being compensated. People should not fear, they should not be apprehensive.</div>
</li>
<li>
<div class="collapsible-header">
16.During construction of the metre gauge, the man eaters of Tsavo terrorized the British. What cases have been encountered during construction of SGR? Has there been human – wildlife conflict and how was it resolved? 
</div>

<div class="collapsible-body">
&nbsp;There have been minimal conflicts, between the workers constructing the SGR and the animals. How have we achieved this? 1. We had consultation with KWS before we entered the National Park; they gave their guidelines on how to work within the park. 2. The security at the park is being provided by the KWS rangers who understand how to handle animals. So besides the regular administration police, we have the KWS rangers who specialize in handling animals. This has resulted to very minimal conflict between the wildlife and the workers.</div>
</li>
<li>
<div class="collapsible-header">
17.Seeing that some of the bridges are over 40meters high, what safety measures have been put in place to avoid toppling over? 
</div>

<div class="collapsible-body">
&nbsp;First we have ensured the safety of the pillars for the bridges are constructed using very good quality materials. Secondly when you design a railway line there are certain measures that we have to consider; the wind forces, centrifugal forces and all other kind of forces even those caused by the train itself. All those things are what are called factors of safety. You design and ensure that nothing will happen. First the curvature of the line we are designing is very flat, we are almost going on a straight line, there are not many forces caused by going through a circular system. Secondly we design even for earthquakes. We designed the structures to be able to withstand earthquakes. I would assure Kenyans that there is no risk of having high bridges, even going to the Rift Valley there will be higher bridges, because of the valleys and the canons that will pass on Mau going down the Rift Valley from Kijabe escarpment. The design is such that nothing happens. We will take care of every force that can topple the train. There should be no cause of alarm.</div>
</li>
<li>
<div class="collapsible-header">
18.Like the metre gauge which gave rise to towns including major towns like Nairobi, Nakuru and Eldoret, has construction of the SGR so far given rise to any new towns and business establishments? 
</div>

<div class="collapsible-body">
<strong>&nbsp;</strong>Between Nairobi and Mombasa the railway runs parallel to the old meter gauge. What KR expects to see is spurring the growth of those towns that already exist For example Mariakani, Voi, Mtito Andei, Kibwezi, Emali and Sultan Hamud. But in other areas, for instance between Kwale and Kajiado it is a bit far from the meter gauge line, we would expect the growth of new towns in those particular areas. Going forward to Western Region the railway will not pass where the existing one passes. It will pass through Narok, Bomet and other smaller towns, new towns will definitely develop. What the railway has done, actually during construction is actually to revive this towns. It has given life to towns like Voi, Mtito Andei, Emali and Sultan Hamud. People have actually benefited from the project.</div>
</li>
<li>
<div class="collapsible-header">
19.Give a comparison of the construction of the metre gauge and the SGR. 
</div>

<div class="collapsible-body">
&nbsp;First on the metre gauge railway from Nairobi to Mombasa, it is 518km.On the SGR it is 472km.That tells a person that the SGR is fairly straight. Secondly the construction of the metre gauge railway was normally done with low labour intensive methods. It was manual and they were actually following what we call contours. They were not trying to make things straight. The SGR however is highly mechanized, from digging the soil to actually building the bridges and laying the tracks. It is highly mechanized. In MGR they used steel sleepers or what the Americans call the ties which are not very heavy. The SGR we are using sleepers which are 275 kg, which cannot be handled by human labour. The SGR is highly mechanized in terms of construction and even in terms of future maintenance. Whereas the, MGR we have people doing maintenance. In terms of maintenance and construction they are actually miles apart.</div>
</li>
<li>
<div class="collapsible-header">
20.Some people were raising questions and asking, “Why the SGR was not put on the MGR and then finish the job.” Why was that not done? 
</div>

<div class="collapsible-body">
&nbsp;The construction of the MGR was done on what we call 18 tones axle load; we are designing a railway of what we call 25 tones axle load. The supporting base must be much stronger. Secondly if you were do that you would not achieve good gradient and curvature. hence not achieving what you want to achieve in terms of speed and capacity. Mind you, you will have to disrupt the services of the MGR to be able to do what people are proposing. What we are saying is that 70% of the world uses the SGR. We want to join the rest of the world we do not want to follow the world and yet most of the people opposing and raising those issues are among the 70% using the SGR. So why don’t they want us to join the rest of the world? When you are in the MGR and you want a wagon or a locomotive, you have to order a specific one or modify those that are existing and are too expensive, but with the SGR you can go and shop anywhere in the world for a wagon or a coach without ordering, that’s what we want to achieve. We want to achieve speed, efficiency and we want to be able to get equipments at a lower cost and we also want modern infrastructure that will spur economic growth to our country and the region.</div>
</li>
<li>
<div class="collapsible-header">
21.The construction of the SGR phase one is near completion, what plans have you put in place for operations? 
</div>

<div class="collapsible-body">
&nbsp;One is human capacity. What we are doing is that we have sent 25 engineers to study railway engineering in Beijing Jiatong University. We are training about 105 personnel in our Railway Training Institute to ensure we have Kenyans equipped in basic skills of the SGR and railway operation. We have encouraged the contractor to train the people they have employed to ensure that they have skills necessary for maintenance in future. Secondly we are looking for a transaction adviser to advise us on the best operating model for the railway so that it meets worldwide best practices. We cannot build a railway of 327 billion then again we don’t have good operations. That is why initially you have probably heard that we might go for an international operator then we will operate the railway ourselves after we have built capacity.</div>
</li>
<li>
<div class="collapsible-header">
22.What are some of the key lessons learnt under phase one that would affect implementation of phase two of the project? 
</div>

<div class="collapsible-body">
&nbsp; We have learnt that we need to engage with the stakeholders early, hence reduce the number of disputes going forward. We need to explain the project much earlier to the Kenyans, let them have a buy in so that when we start, they will know the kind of disruptions we will have on the way. Like what materials we will extract. They know where they can participate and will also beware of the environmental concerns of the project. Stakeholders’ engagement even prior to the project is very important. We also need to engage the locals on the specifications of the materials required for construction of the SGR so they do not complain and ask why aren’t Kenyans supplying all the cement and all the steel? We do not produce certain products because they are of high standards and there is no consumer in the country. The other issue is on local content, making sure that now we inbuilt it into the contract so that the contractor is now obligated to report on what is happening in that particular area. Those are some of the lessons that we have learnt and which we will actually going forward implement to avoid a repeat of such challenges.</div>
</li>
<li>
<div class="collapsible-header">
23.The project’s completion date is fast approaching. What measures have been taken to ensure that the country is well positioned to take over operations, maintain and manage this humongous infrastructure? 
</div>

<div class="collapsible-body">
&nbsp;We as Kenya Railways feel very privileged to be the people to implement this. We want to thank the government first of all for placing us in this position. The issue of the readiness of Kenya Railways and the country to operate this railway starts from the training and development of manpower, because it is the man not the machine who determine the effectiveness of an entity. And to this date we have elaborate programmes in&nbsp;&nbsp; place in building the project to ensure that people are trained well in advance of the actual launch of the project. We already have 20 trainees that have gone to China to undergo degree training in railway courses: railway management, railway maintenance and railway operations. We have another 105 trainees undergoing training in R.T.I. currently. We have another 35 who will be going to China in the very near future. We have another 20 who are also undergoing training through arrangements between the consultant and the contractor. So as you can see we have elaborate programmes to ensure that when the project is complete we have enough local manpower to run it.</div>
</li>
<li>
<div class="collapsible-header">
24.Are there local skilled and unskilled laborers who have gained a lot from the job training? 
</div>

<div class="collapsible-body">
At the moment during this phase of the construction we have a lot of local people, in fact close to 90% are locals, which is quite substantial. This pool of skilled labour will transit, to operations and others into project construction. There is plenty for Kenyans to do.</div>
</li>
<li>
<div class="collapsible-header">
25.Recently, KR advertised for a Transaction Advisor. What does this mean? Already, there are reports that CRBC will undertake and supervise operations on the line. 
</div>

<div class="collapsible-body">
&nbsp;Well we requested for a transaction advisor because SGR is a fairly new area to us as Kenya Railways and you know the country does not really have the capacity to be able to run this. We would like a consultant who can manage this between the contractor and Kenya Railways, ensuring that there is a proper mechanism for managing the affairs. That ensures that there is a proper contractual agreement which has been developed to manage the relationships between ourselves and the contractor. We want this adviser to develop performance indicators, so that we are able to see and engage the efficiency and the performance and be able to determine how we relate in the future. That is crucial for a project of this nature having not have operated such a project ourselves; we need such kind of a platform to develop data for future project management for this kind of project.</div>
</ul>
      </div></div><?php 
    }
include 'footer.php'; ?>