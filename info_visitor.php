<!DOCTYPE html>
<html lang="sv">
<head>
    <title>NeoCare</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#094E79"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


    <link rel="icon" href="vgr.png" type="image/gif" sizes="16x16">

<script>
    $(document).ready(function () {

        $('a[href^="#"]').on('click', function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);

            //Scroll and show hash
            //$('html, body').animate({
            //'scrollTop': $target.offset().top
            //}, 1000, 'swing', function () {
            //	window.location.hash = target;

            //Scroll and don't show hash
            $('html, body').animate({
                'scrollTop': $target.offset().top
            }, 1000, 'swing');

            //});
        });
    });

</script>
</head>






<body>
 <?php include 'myHeader.php' ?>

<!--<div class="container">-->

<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Hem</a></li>
                <li class="active"><a href="info_visitor.php">Information</a>
                </li>
                <li><a href="kontakt_visitor.php">Kontakt</a></li>

            </ul>
            
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
<div class="container">
    <!-- LOG IN MODAL -->
    <div id="modalLogin" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align-last: center">Logga in</h4>
                </div>
                <div class="modal-body">

                    <form action="process.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="user" id="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" name="pass" id="pwd">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">

       
        <!-- Trigger the modal -->
        <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Att ta hem ett för tidigt fött barn</button>-->
		
		<div class="checklistContainer" id="task1">
			<h2>Här kan du ta del av information för vården av ert barn</h2>
            <ul>
              <li><a href="#" data-toggle="modal" data-target="#myModal1">Att ta hem ett för tidigt fött barn</a></li>
			  <li><a href="#" data-toggle="modal" data-target="#myModal2">Att amma det för tidigt födda barnet</a></li>
			  <li><a href="#" data-toggle="modal" data-target="#myModal3">Föräldrainformation angående UL skalle och MR hjärna</a></li>
		      <li><a class="linksor" href="http://www.trafikverket.se/resa-och-trafik/Trafiksakerhet/Din-sakerhet-pa-vagen/Sakerhet-i-bil/Barn-i-bil/Babyskydd/" target="_blank">Babyskydd i bil - Trafikverket (Öppnas i ny flik)</a></li>
			  <li><a class="linksor" href="http://www.socialstyrelsen.se/Lists/Artikelkatalog/Attachments/19486/2014-8-2.pdf" target="_blank">Minska risken för plötslig spädbarnsdöd - Socialstyrelsen (Öppnas i ny flik)</a></li>
            </ul>     
        </div>
		
		
		

        

        <!-- ### ATT TA HEM ETT FÖR TIDIGT FÖTT BARN ### -->
        <!-- Modal -->
        <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Att ta hem ett för tidigt fött barn</h4>
                    </div>
                    <div class="modal-body">
                        <h3><b>Att ta hem ett för tidigt fött barn</b></h3>
                        Ny när det är dags att åka hem kan barnet fortfarande vara extra
                        känsligt för allt för mycket intryck och stimulans på samma gång.
                        Undvik att hålla på med flera aktiviteter samtidigt, var lugn och stilla när du är med ditt
                        barn.
                        <br><br>
                        Om barnet är vaket låt det titta på ditt ansikte, lyssna på din röst.
                        Om barnet tittar på dig och sedan vänder bort ansiktet kan det behöva en
                        paus. Lär dig förstå barnets beteende, tecken på trötthet, behov av
                        vila, välbefinnande och avslappning. Under första dygnet hemma kan
                        barnet bete sig annorlunda än på sjukhuset. Det sover kanske mer än
                        vanligt eller gråter och blir oroligt. Detta beror troligtvis på den nya
                        miljön och går över efter några dagar.
                        <br><br>
                        <h3><b>Infektionskänslighet</b></h3>
                        Nyfödda och prematura barn har sämre skydd mot infektioner än
                        senare i livet. Undvik därför att vistas med barnet i offentliga lokaler
                        där många människor samlas och undvik kontakt med personer som
                        är infekterade. God hygien i hemmet och att tvätta händerna ofta ger
                        ett bra skydd mot infektioner. Blir du som förälder förkyld undvik nära
                        kontakt med barnet till exempel pussar, att suga på barnets tröstnapp,
                        och var noga med handhygien.
                        <br><br>
                        <h3><b>Barnets måltider i hemmet</b></h3>
                        Måltiderna varierar från barn till barn och kan även variera under
                        dygnet. Det är normalt att ett barn vill äta var fjärde, ibland varannan
                        timme. Ett barn som väger under tre kilo ska äta minst 6-8 måltider
                        per dygn för att få tillräckligt med näring. Ett bra tecken på att barnet
                        får i sig den matmängd det behöver är att barnet kissar och går upp i
                        vikt.
                        <br><br>
                        Du som använder amningsnapp kan prova utan denna någon gång
                        per dag för att vänja barnet att suga direkt på bröstet.
                        <h3><b>Kontroll av sondläge och sondmatning</b></h3>
                        Ge aldrig mat i sonden utan att först kontrollera att den är rätt placerad
                        <br>
                        För att kontrollera sondläge, gör följande:
                        <br>
                        <ul>
                            <li>Sätt den avsedda sprutan till sonden och dra långsamt tillbaka.</li>
                            <li>Om det kommer maginnehåll (Mjölkrester eller magsaft) spruta ut lite av det
                                på lackmuspapper som ska färgas rosa. Detta garanterar att sonden ligger i magsäcken.
                            </li>
                        </ul>
                        <br><br>
                        Hela måltiden bör vara 30-40 minuter för att undvika illamående
                        och kräkningar. Låt barnet amma en stund/äta klart på bröstet
                        innan du börjar sondmata. Ge barnet en paus om det visar tecken
                        på ansträngning, till exempel bli oroligt eller att barnet andas
                        annorlunda. Ha barnet nära och under tillsyn under hela sondmatningen.
                        <br><br>
                        Var uppmärksam på att sonden inte flyttar sig under måltiden
                        (glider eller att barnet rycker ut den) samt hur barnet reagerar på maten.
                        Sonden rengöres från mat genom att 2 ml luft sprutas ner efter
                        måltidens slut. Om barnet drar ut sonden ta kontakt med
                        avdelningen för vidare planering. Sondsprutor som används i
                        hemmet sköljs ur efter användning och byts 1-2 ggr/dygn eller vid
                        behov. Tröstnappar, amningsnappar, nappflaskor, flasknappar
                        och pumpflaskor diskas och sköljes efter användning och kokas 1
                        gång/dygn.
                        <br><br>
                        <h3><b>Hantering av bröstmjölk och ersättning</b></h3>
                        Färsk och tinad bröstmjölk är hållbar 48 timmar i kylskåp (+4-6 grader). Häll inte ihop varm
                        (nypumpad) bröstmjölk med kall bröstmjölk. Spara aldrig uppvärmd bröstmjölk eller ersättning.
                        <br><br>
                        Tillredd ersättning är hållbar i 12 timmar i kylskåp.
                        <br><br>
                        Donerad bröstmjölk är som pastöriserad (kodad BM) är hållbar 48 timmar i kylskåp.
                        <br><br>
                        Fryst bröstmjölk är hållbar 3 månader
                        <br><br>
                        <h3><b>Bröstvård</b></h3>
                        Brösten behöver inte tvättas före varje amning. Det räcker med
                        normal god kroppshygien. När du duschar och tvättar brösten,
                        använd inte tvål på bröstvårtan – det torkar ut. Låt brösten lufttorka
                        efter amning. Bröstmjölken som finns kvar på bröstvårtan när
                        barnet släpper taget är fet och steril. Den innehåller dessutom
                        bakteriedödande ämnen och ämnen som motverkas
                        svampinfektioner. Använd en stödjande BH som inte sitter åt.
                        Undvik bygel-BH. Var noga med handhygienen.
                        <br><br>
                        <h2><b>Barnskötsel</b></h2>
                        <br><br>
                        <h3><b>Bad</b></h3>
                        Ni kan bada ert barn ca en gång per vecka eller vid behov.
                        Badvattnet ska vara ca 37 grader. Man kan använda underarmen
                        eller en badtermometer för att kontrollera att vattnet är lagom
                        varmt. Ha gärna lite oparfymerad badolja i vattnet. Tvål behövs
                        oftast inte. Man börjar med att tvätta barnets ansikte och avslutar
                        med stjärten. Glöm ej att tvätta i alla hudveck och därefter torka
                        dessa torra.
                        <br><br>
                        <h3><b>Ögon</b></h3>
                        Kladdiga ögon är vanligt bland nyfödda på grund av trånga
                        tårkanaler hos det lilla barnet. Ögonen kan tvättas med ljummet
                        kranvatten flera gånger om dagen vid behov. Om ögonen trots det
                        blir mer kladdiga, svullna och röda, rådgör med avdelningen.
                        <br><br>
                        <h3><b>Magen</b></h3>
                        Det är vanligt att små barn besväras av magknip och gaser. Barn
                        som bara äter bröstmjölk kan bajsa flera gånger om dagen eller
                        mer sällan, till exempel en gång i veckan. Barn som äter
                        bröstmjölksersättning kan lättare få hård avföring. Dessa barn bör
                        bajsa varje dag. Om du märker att barnet har svårt att bajsa rådgör
                        med avdelningen.
                        <br><br>
                        <h3><b>Hud</b></h3>
                        Undvik att använda våtservetter till ditt lilla barns hud, då dessa
                        kan innehålla ämnen som gör ditt barns hud irriterad. Tvål är uttorkande
                        så det är bättre att tvätta med olja om barnet har bajsat. Om ditt
                        barn blir röd i stjärten kan det hjälpa med att låta barnet lufta
                        stjärten samt att stryka några droppar bröstmjölk på huden. När du
                        byter blöja observera barnets ljumskar så att det inte samlas vita
                        beläggningar i vecken. Se också till att det inte är hudsprickor och
                        irriterad hud. Var noga med att hålla huden torr och ren.
                        Inotyolsalva är vattenavstötande och kan ibland behöva användas
                        för att skydda en röd stjärt.
                        <br><br>
                        Naveln hålls torr. Var observant på dålig lukt eller rodnad. Vid
                        rodnad runt naveln, kontakta avdelningen
                        <br><br>
                        <h3><b>Barnets temperatur</b></h3>
                        Barnet behöver hålla normal kroppstemperatur, det vill säga 36,5-
                        37,5 grader för att må väl, spara energi och öka i vikt. Det räcker att
                        mäta barnets temperatur vid ett tillfälle per dygn. Man kan få en
                        uppfattning om barnet är kallt eller varmt genom att känna på
                        barnets nacke och rygg eller mage. Ofta kan barnets händer och
                        fötter kännas kalla utan att kroppstemperaturen är för låg.
                        <br><br>
                        <h3><b>Utevistelse</b></h3>
                        Det är bra både för föräldrar och barn att gå ut på promenad någon
                        gång per dag. Känn på barnet om det känns varmt eller kallt. Ta
                        alltid av barnet ytterkläderna när ni kommer in igen. Låt inte barnet
                        sova själv utomhus den första tiden hemma. När barnet är större
                        finns det inga hinder för detta.
                        <br><br>
                        <h3><b>Sovställning</b></h3>
                        Barnet ska sova på rygg. Ha det gärna en tunn mjuk kudde under
                        huvudet. Variera vilken sida huvudet ligger åt för att undvika att det
                        blir omformat. När barnet är vaket och under uppsikt kan det ligga
                        på mage. Enligt Socialstyrelsen rekommenderas inte samsovning.
                        <br><br>
                        <h3><b>BVC</b></h3>
                        Under tiden ni är i Neonatal Hemsjukvård ska ni inte gå till BVC.
                        Alla kontroller av barnet sker hos oss. När det börjar närma sig
                        utskrivning kommer vi att be er ringa till BVC och boka en tid för
                        första viktkontrollen. BVC har fått information om detta men ibland
                        brukar de ändå ringa till våra föräldrar. Tala då om för dem att ni
                        fortfarande är inskrivna på avdelning 34 och att ni hör av er när
                        vårdtiden är slut.
                        <br><br>
                        <h3><b>Andningsproblem</b></h3>
                        Det är normalt att spädbarn andas oregelbundet och ibland gör pauser upp till 20 sekunder.
                        Barnet
                        kan också låta som att det kippar efter andan och det är också normalt så länge barnet inte blir
                        blått
                        eller har ett längre andningsuppehåll.
                        <br><br>
                        <h4><i>Vad gör jag om barnet mot förmodan slutar att andas?</i></h4>
                        Lyft upp ditt barn och stimulera barnet genom att gnida längs
                        ryggraden eller bröstet. Det räcker oftast för att ditt barn ska börja
                        andas igen. Kontakta avdelningen. Om barnet inte börjar andas
                        efter att ha stimulerats i ca ½ minut, starta hjärt-lungräddning (HLR)
                        och ring 112.
                        <br><br>
                        <h3><b>Utskrivning</b></h3>
                        Då barnet är moget för utskrivning från hemsjukvården görs en
                        läkare undersökning. Många av barnen kommer att följas upp via
                        neomottagningen under barnets första år.
                        <br><br>
                        <h3><b>Till sist</b></h3>
                        Det är väldigt viktigt att ni vågar slappna av när ni kommer hem. Ni
                        som föräldrar känner barnet bäst. Njut av den första tiden hemma
                        utan att ha en massa ”måsten”. Ta tid för ej själva och er nya
                        familjemedlem.
                        <br><br>
                        Lycka till framöver!


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- ### ATT AMMA DET FÖR TIDIGT FÖDDA BARNET ### -->
        <!-- Modal -->
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Att amma det för tidigt födda/sjuka barnet</h4>
                    </div>
                    <div class="modal-body">
                        <h3><b>1. Hud mot hud</b></h3>
                        Ett bra utgångsläge för amning är genom hud mot hud kontakt. Om barnets eller
                        mammas tillstånd inte tillåter detta i direkt anslutning till förlossningen görs en "omstart"
                        när tillfälle ges.
                        <br>
                        Omstart innebär att barnets kläs av förutom blöja och läggs hud mot hud så snart som mor och
                        barn träffas.
                        Om barnet av någon anledning inte kan ligga hos mamma kan pappa ha barnet hud mot hud, därefter
                        kan
                        mamma och pappa turas om.
                        <br><br>
                        <h3><b>2. Lägga till bröstet</b></h3>
                        Det för tidigt födda eller sjuka barnet kanske inte är moget/orkar att suga på bröstet,
                        men det kan ligga där och lukta och mamma kan pressa fram mjölk så att barnet kan smaka.
                        <br>
                        Att erbjuda barnet att ligga vid bröstet är en bra början men ha inga större krav på att barnet
                        ska suga.
                        <br><br>
                        <h3><b>3. Få tag om bröstet</b></h3>
                        Hjälp barnet att få tag om bröstet när barnet söker aktivt. Barnet kan ännu inte hålla kvar
                        taget en längre stund.
                        Du kan nu behöva hjälp med ett bra amningsläge och teknik. Barnet matas med sond.
                        <br><br>
                        <h3><b>4. Håll kvar taget</b></h3>
                        Barnet suger och sväljer. Nu är det dags att titta på hur barnet suger och lyssna på hur barnet
                        sväljer
                        för att kunna uppskatta amningsmängd. Minska ev. sond.
                        <br><br>
                        <h3><b>5. Ammar större mängder</b></h3>
                        Var uppmärksam på när barnet visar tecken på att vilja suga. Barnet kan slicka
                        på läpparna, söka med munnen, vrida på huvudet och suga på fingrarna. Du kan lägga
                        barnet till bröstet så snart det visar sugvillighet. Barnet ammar nu varierande
                        mänger olika mål. Tidsintervallet mellan amningarna kan variera. Delar av måltiden
                        med sond kan nu minskas.
                        <br><br>
                        <h3><b>6. Halvfri amning</b></h3>
                        Barnet kan själv bestämma när det ska få äta. Det visar nu mer hungerkänslor och vill
                        kanske suga ofta, en del längre och en del kortare stunder. Barnet kanske vill amma
                        tätare med olika tidsintervaller. Det är viktigt att mamma är uppmärksam på barnets
                        tecken på hunger. Nu kan tillmatningen med sond minskas ytterligare.
                        <br><br>
                        <h3><b>7. Fri amning</b></h3>
                        Avsluta tillmatningen på sond. Tecken på att amningen fungerar är att barnet suger
                        lugnt på bröstet, suger med långa djupa sugtag och det hörs att barnet sväljer.
                        Bröstet känns mjukare efter amningen. Barnet kissar blek, luktlös urin flera gånger per
                        dygn och bajsar gult regelbundet. Barnet ökar i vikt.
                        För de allra flesta går amningen bra efter en inlärningstid på en till tre månader.
                        <br><br>
                        <h2><b>Amningsläge och teknik</b></h2>
                        <ul>
                            <li>Sitt med rak rygg eller lätt framåtlutad och med båda fötterna på golvet</li>
                            <li>Håll handflatan mot barnets skulderblad med tummen och fingrarna på barnets axel.
                                Barnets
                                huvud ska kunna falla lätt bakåt
                            </li>
                            <li>Ge stöd med andra handen under bröstet.</li>
                            <li>Barnet ska ligga med magen mot mamma, hakan mot bröstet och näsan mitt emot
                                bröstvårtan.
                            </li>
                            <li>Invänta att barnet gapar stort och sträcker fram sin tunga.</li>
                            <li>Rikta vårtan upp möt gommen och för barnet till bröstet.</li>
                            <li>Barnets haka ska gå djupt in i bröstet mot undersidan av vårtgården. Bröstvårtan hamnar
                                då upp mot den mjuka gommen längst bak i munnen där den ligger skyddad mot nötning.
                            </li>
                            <li>De första sugtagen kan göra riktigt ont men smärtan bör snart gå över och barnet börjar
                                suga med långa djupa sugtag.
                            </li>
                            <li>När barnet har fått bra tag kan man försiktigt smyga under med den andra handen utan att
                                ändra barnets position vid bröstet.
                            </li>
                            <li>Tryck barnets stjärt mot din kropp och släpp sedan efter lite på huvudet, då går näsan
                                fri.
                            </li>
                            <li>Sänk axlarna och låt överarmarna hänga rakt. Försök slappna av i kroppen.</li>
                            <li>Du ska inte känna någon smärta i bröstvårtan, men det kan svida i början.</li>
                            <li>Barnet ska ha runda kinder (ingen grop i kinden och mungipan syns inte)</li>
                            <li>Hakan pressas djupt in i bröstet (inget mellanrum mellan haka och bröstet) smat en stor
                                dubbelhaka.
                            </li>
                            <li>Käkmusklerna arbetar.</li>
                            <li>När mjölken börjar rinna till, sväljer barnet hörbart.</li>
                            <li>Bröstvårtan ska vara rund efter amning, inte ihopklämd eller sned.</li>
                            <li>Kontrollera tecknen på ett bra tag då och då under amningen. Om taget är fortsatt bra,
                                låt barnet suga tills det släpper taget själv. Om taget inte är bra, lossa barnet och
                                börja om.
                            </li>
                        </ul>
                        <br>
                        <h3><b>Tillmatning</b></h3>
                        Barnläkaren beslutar om barnet behöver tillmatas och föräldrarna tillfrågas alltid om det går
                        bra att
                        barnet får donerad bröstmjölk. Om barnet behöver mat ges det med en kopp eller en sond. Barnet
                        får donerad bröstmjölk eller bröstmjölksersättning eftersom det tar några dygn för den nyblivna
                        mammans mjölkproduktion att komma igång.
                        <br>
                        <br>
                        Barnet får ammas när det orkar och vill. Mammas och pappas delaktighet hela dygnet är viktigt,
                        även
                        om de inte behöver vara med barnet på samma gång.
                        <br><br>
                        <h3><b>Pumpning</b></h3>
                        När barnet är för tidigt fött eller sjukt kan du som mamma behöva handmjölka eller pumpa med en
                        elektrisk bröstpump för att få igång och sedan upprätthålla bröstmjölksproduktionen. Du kan
                        börja så
                        snart du orkar efter förlossningen och sedan fortsätta regelbundet ungefär var tredje timma
                        eller
                        åtta gånger som kan vara ojämnt fördelande över dygnet.
                        <br><br>
                        Det är viktigt att även pumpa på natten. I början kanske det bara kommer några droppar så kallad
                        råmjölk.
                        <br><br>
                        Det tar olika lång tid för olika kvinnor innan bröstmjölken rinner till. Det är antalet gånger
                        som
                        brösten stimuleras med pumpning som är viktig för att kroppen att förstå att den ska stimulera
                        bröstmjölk. Även om det inte kommer något, så stimulerar pumpningen bröstmjölksproduktionen.
                        <br><br>
                        Utdrivningsreflexen underlättas av att du sitter hud mot hud med ditt barn och att du sittter
                        bredvid
                        barnet när du pumpar. För att kunna producera bröstmjölk är det viktigt med vila, mat och dryck.
                        Du
                        bör få fyra till fem timmars sammanhängande nattsömn.
                        <br><br>
                        <h3><b>Pumpning</b></h3>
                        Det finns mammor som av medicinska eller andra skäl inte ammar och det finns mammor där
                        amningen blir så svår att hantera trots råd och stöd att man väljer att avbryta. Mamma kan
                        fortsätta
                        amma alltifrån en eller flera gånger per dygn till bara någon gång per vecka under förutsättning
                        att
                        barnet också vill.
                        <br><br>
                        Du som vill behålla mjölkproduktionen, bör känna till att när modersmjölkersättning introduceras
                        minskar din egen mjölkproduktion om brösten inte stimuleras. Att öka mjölkproduktionen igen
                        kräver tid och motivation.
                        <br><br>
                        Flaskmatning är något som barnet kan behöva lära sig:
                        <br><br>
                        <ul>
                            <li>En måltid med nappflaska är ett tillfälle för närhet och samspel mellan barn och
                                förälder.
                                Matning med nappflaska bör alltid ske i förälderns farmn.
                            </li>
                            <li>Låt barnet känna din lukt och gärna komma nära din hud.</li>
                            <li>Försök hålla barnet på ett sådant sätt att ditt barn kan ha ögonkontakt med dig. En del
                                barn
                                kan vara svårare att få ögonkontakt med - ha tålamod!
                            </li>
                            <li>Håll nappflaskan stilla nära din kropp. När barnet är nyfiket och vill titta ut i
                                rummet, får
                                hon/han släppa taget om flaskan. Du behöver inte följa med i rörelsen utan barnet får
                                söka
                                sig tillbaks till dig och nappflaska igen.
                            </li>
                        </ul>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- ### U-ljud skalle och MR hjärna ### -->
        <!-- Modal -->
        <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Föräldrainformation angående UL skalle och MR hjärna</h4>
                    </div>
                    <div class="modal-body">
                        <h3><b>U-ljud skalle och MR hjärna</b></h3>
                        Alla barn som är födda före v 32 och/eller som har en födelsevikt &lt; 1500 g genomgår
                        rutinmässig
                        ultraljudsundersökning av hjärnan. Detta pga att dessa barn har risk för att få blödningar i
                        hjärnan
                        pga omogna och sköra kärl. Denna risk är störst under första levnadsdygnet och sjunker sedan
                        mycket snabbt, så att risken efter tredje levnadsdygnet är mycket liten. Oftast är blödningarna
                        helt
                        harmlösa och sitter precis i kanten mellan det vätskesystem vi alla har i huvudet och själva
                        hjärnan.
                        Dessa små blödningar är precis som små blåmärken och försvinner utan att ge några som helst
                        symptom eller skador. Även lite större blödningar som går in i vätskesystemet kan vara helt
                        övergående utan komplikationer. Lite större blödningar kan ibland störa flödet för hjärnvätskan
                        efter
                        någon veckas ålder. Vid några veckors ålder är inte nya blödningar det man ffa letar efter. Man
                        kan
                        däremot ibland upptäcka andra förändringar som mer har att göra med att barnet tidigare varit
                        svårt
                        sjukt och i samband med detta haft störningar i sin cirkulation och försörjning till
                        hjärnvävnaden.
                        <br><br>
                        Rutinmässigt ultraljud görs som regel vid 3 och 7 dygns ålder, samt därefter vid 2 och 4 v ålder
                        och
                        vid utskrivning. Undersökning kan i övrigt göras vid behov dygnet runt. Som regel kan du som
                        förälder vara med (om du vill) och du får besked direkt i samband med undersökningen.
                        <br><br>
                        Magnetkameraundersökning av hjärnan görs rutinmässigt på alla barn födda &lt; v 28+0 och/eller
                        med
                        födelsevikt &lt; 1000 g. Dessutom på barn med större blödningar eller andra förändringar man har
                        hittat med ultraljud. Dessutom görs magnetkameraundersökning på barn med t ex krampsjukdom
                        och liknande neurologiska problem. Magnetkameraundersökningen görs tidigast vid motsvarande
                        fullgången tid, då hjärnan är tillräckligt mogen för att en rimlig bedömning ska kunna göras. Om
                        magnetkameraundersökning ska göras, kommer ni att få information om hur det går till i god tid.


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                    </div>
                </div>

            </div>
        </div>


    </div> <!-- /container -->
</div>
<br><br><br><br><br><br>

<footer class="footer">
    <?php include 'footer.php' ?>
</footer>


</body>
</html>







