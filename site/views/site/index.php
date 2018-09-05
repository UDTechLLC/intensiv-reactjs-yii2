<?php
    /** @var array $packages */
    /** @var array $sectionsAliases */
    /** @var array $sections */
    /* @var $this \yii\web\View */
?>
<!DOCTYPE html>
<html class="loading" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <title>intensivkursstockholm.se</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="assets/css/libs.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="page" id="app">
    <!-- block HEADER-->
    <div class="header flex">
        <div class="map" id="map-layout">
            <!--img(src="" + imagePath + "map.jpg", alt="map")-->
        </div>
        <div class="block-absolute-links">
            <a href="#" target="_blank" id="instagram">
                <div class="icon">
                    <img class="svg" src="assets/images/logo.png" alt="logo Intensivkurs Stockholm" style="width:177px">
                </div>
            </a>
            <div class="modal-info-button" data-target="#info-modal" data-toggle="modal">GDPR</div>
        </div>
        <div class="filter-section">
            <div class="flex flex-center header-filter">
                <a class="b_logo" href="#"><img src="assets/images/logo.png" alt="Intensivkurs Logo"></a>
            </div>
            <div class="body">
                <form method="POST" id="phone-header-form" action="#">
                    <div class="drive">
                        <h3>Välj en fordonsbehörighet</h3>
                        <div class="section flex">
                            <div class="button-license b car-block">
                                <input type="radio" name="license" value="b">
                                <div class="wrap-btn">
                                    <div class="icon">
                                        <img class="svg" src="assets/images/b.svg" alt="B Logo">
                                    </div>
                                    <span id="car-licence">B</span>
                                </div>
                                <div class="dropdown animated fadeIn">
                                    <input type="radio" name="license" value="ub" id="license-ub">
                                    <label for="license-ub"><span>UB</span>Bil + Släpvagn (Max 4.25 ton)</label>
                                    <input type="radio" name="license" value="be" id="license-be">
                                    <label for="license-be"><span>BE</span>Tung släpvagn (Max 3.5 ton)</label>
                                </div>
                            </div>
                            <div class="button-license a bike-block">
                                <input type="radio" name="license" value="a">
                                <div class="wrap-btn">
                                    <div class="icon"><img class="svg" src="assets/images/a.svg" alt="A Logo"></div>
                                    <span id="bike-licence">A</span>
                                </div>
                                <div class="dropdown animated fadeIn">
                                    <input type="radio" name="license" value="a1" id="license-a1">
                                    <label for="license-a1"><span>A1</span>Lätt motorcykel (Max 11 Kw)</label>
                                    <input type="radio" name="license" value="a2" id="license-a2">
                                    <label for="license-a2"><span>A2</span>Mellanstor motorcykel (Max 35 Kw)</label>
                                </div>
                            </div>
                            <div class="button-license am scooter-block">
                                <input type="radio" name="license" value="am">
                                <div class="wrap-btn">
                                    <div class="icon"><img class="svg" src="assets/images/am.svg" alt="AM Logo"></div>
                                    <span id="scooter-licence">AM</span>
                                </div>
                                <div class="dropdown animated fadeIn">
                                    <input type="radio" name="license" value="am-1" id="license-am-1">
                                    <label for="license-am-1"><span>Klass 1</span> Körkort 45 km/h</label>
                                    <input type="radio" name="license" value="am-2" id="license-am-2">
                                    <label for="license-am-2"><span>Klass 2</span> Förarbevis 25 km/h  </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="home">
                        <h3>Område och utbildningspaket</h3>
                        <div class="section">
                            <select2 class="select-contain" name="place">
                                <option disabled selected value="placeholder">Välj ort</option>
                                <option v-for="place in listPlaces" :value="place.city">{{place.city}}</option>
                            </select2>
                            <select2 class="select-contain" name="packet">
                                <option disabled selected value="placeholder">Välj körpaket</option>
                                <option v-for="package in listPackages" :value="package.section">{{package.section}}</option>
                            </select2>
                            <script type="text/x-template" id="select2-template">
                                <select>
                                    <slot></slot>
                                </select>
                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Lämna ditt mobilnummer" required pattern="^[_A-z0-9]{1,}$">
                        <div class="help-block"></div>
                    </div>

                    <input class="btn-blue" type="submit" value="SKICKA INTRESSEANMÄLAN">
                </form>
            </div>
        </div>
        <div class="school-view">
            <button class="close"><span class="icon"><img class="svg" src="assets/images/arrow-down.svg" alt="arrow"></span></button>
            <h2>Intensivkurs Stockholm</h2>
            <p class="description">Kvalitet och miljö TA-2017</p>
            <div class="contact-info">
                <div class="info-block location">Grimstagatan 160, 162 58 Vällingby</div>
                <div class="info-block email">info@vasterorttrafikskola.se</div>
                <div class="info-block phone">08-533 301 01</div>
                <input class="btn-blue" type="button" value="KONTAKTA OSS" data-target="#form-modal" data-toggle="modal">
            </div>
        </div>
    </div>
    <!-- block CONTENT-->
    <div class="content">
        <!-- start plan section-->
        <section class="b_section plans">
            <div class="container">
                <h2 class="b_section_title">ERBJUDANDE FRÅN INTENSIVKURS STOCKHOLM</h2>
                <p class="b_section_subtitle b_section_subtitle_bottom_mg">Gäller endast nya elever och ett utbildningspaket</p>
                <ul class="plans_tabs nav nav-tabs" role="tablist">
                    <?php foreach ($sections as $sectionId => $name) { ?>
                        <li<?=$sectionId == 1 ? ' class="active"' : '';?>>
                            <a href="#<?=$sectionsAliases[$sectionId];?>" aria-controls="<?=$sectionsAliases[$sectionId];?>" role="tab" data-toggle="tab">
                                <?=$name;?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <?php foreach ($packages as $sectionId => $packList) { ?>
                    <div class="tab-pane<?=$sectionId == 1 ? ' active' : '';?>" role="tabpanel" id="<?=$sectionsAliases[$sectionId];?>">
                        <div class="row">
                            <?php /** @var \app\models\Package $pack */
                            foreach ($packList as $pack) { ?>
                            <div class="col col-md-3">
                                <div class="card wow flipInY<?=$pack->id == 2 ? ' active' : '';?>" data-wow-duration="1000ms" data-wow-delay="600ms" data-wow-offset="100">
                                    <?= $pack->sale_percent_formatted; ?>
                                    <div class="icon <?=$pack->image;?>"></div>
                                    <h3><?=$pack->name;?></h3>
                                    <div class="price"><?=$pack->full_price_formatted;?></div>
                                    <?=$pack->description;?>
                                    <?php if (!empty($pack->start_date)) { ?>
                                    <div class="date_time">
                                        <span><?=Yii::$app->formatter->asDate($pack->start_date);?></span>
                                        <span><?=Yii::$app->formatter->asTime($pack->start_date);?></span>
                                    </div>
                                    <?php } ?>
                                    <?php if ($pack->required_test_lesson) { ?>
                                        <div class="date_time"><span>En testlektion krävs</span></div>
                                    <?php } ?>
                                    <?php if (!$pack->hide_button) { ?>
                                        <button
                                            class="btn btn-blue btn-small"
                                            @click="openModalPacket('<?=$pack->name;?>',
                                                                    '<?=$pack->price_formatted;?>',
                                                                    <?=$pack->id;?>)"
                                            data-target="#packet-modal"
                                            data-toggle="modal"
                                        >Boka nu</button>
                                    <?php }else{
                                        echo '<div class="block-hide-button"></div>';
                                    } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="b_section b_section-text-area">
            <div class="container">
                <h2 class="b_section_title">INTENSIVKURS STOCKHOLM</h2><!-- INTENSIVKURS STOCKHOLM HAR ALLTID KVALITÉN I FOKUS -->
                <h3 class="b_section_title b_section_title_small">Upptäck nya möjligheter</h3>
                <p class="b_section_subtitle">På vår webbplats intensivkursstockholm.se får du möjligheten att få ett nytt erbjudande till ett kraftigt rabatterat pris på olika körpaket från topptrafikskolor nära dig. Vi gör ständigt vårt bästa för att kunna erbjuda dig oslagbara priser inom körlektioner och kurser, allt för att kunna erbjuda dig kvalitet till ett riktigt bra pris.</p>
                <h3 class="b_section_title b_section_title_small">FÅ EN SNABB UPPKÖRNINGSTID NÄRA DIG</h3>
                <p class="b_section_subtitle">Att boka en privat uppkörning kan ta månader på grund av långa väntetider. Vi på Intensivkurs Stockholm i samarbete med våra trafikskolor kan erbjuda dig en snabb uppkörningstid i en ort nära dig (Jakobsberg, Sollentuna & Farsta). Trafikskolornas uppdrag är att erbjuda dig en resultatrik körkortsutbildning, så att du kan klara av ett körprov på ditt första försök. Uppkörningstiderna kan variera mellan en vecka till två månader.</p>
                <h3 class="b_section_title b_section_title_small">PÅLITLIGA TRAFIKSKOLOR</h3>
                <p class="b_section_subtitle">Intensivkurs Stockholm samarbetar endast med trafikskolor som har ett bra resultat på kunskaps- och uppkörningsproven hos Trafikverket i Stockholm. Statistiken är en kvalitetskontroll på den utbildning som eleverna får hos trafikskolorna. Trafikskolorna väljer själva om de vill medverka med sina resultat hos Trafikverket. Flertalet av trafikskolorna i Stockholm saknar idag statistik hos myndigheten, därför väljer vi att endast erbjuda körpaket hos trafikskolor som medverkar med sin statistik.</p>
            </div>
        </section>

        <div class="section-video">
            <div class="container">
                <h2 class="b_section_title">VÄGEN TILL KÖRKORT</h2>
                <p class="b_section_subtitle b_section_subtitle_bottom_mg">Kontakta oss för en snabb och effektiv körkortsutbildning</p>
                <div class="row">
                    <div class="col col-md-6 col-sm-12 col-xs-12">
                        <div class="video-container wow fadeInUp" data-wow-delay="800ms" data-wow-offset="100">
                            <iframe src="https://www.youtube.com/embed/QafXcUBkOTQ?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer" frameborder="0" allowfullscreen="true" showinfo="0" controls="0"></iframe>
                            <div class="description flex flex-vertical-center flex-between">
                                <p>Vägen till körkort</p>
                                <div class="play-btn"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6 col-sm-12 col-12">
                        <div class="video-container wow fadeInUp" data-wow-delay="500ms" data-wow-offset="100">
                            <iframe src="https://www.youtube.com/embed/tshiDexOecE?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer" frameborder="0" allowfullscreen="true"></iframe>
                            <div class="description flex flex-vertical-center flex-between">
                                <p>Vägen till körkort</p>
                                <div class="play-btn"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- start MER INFORMATION section-->
        <section class="b_section b_section-colored more-inform section-additional-info">
            <div class="container">
                <h2 class="b_section_title">Mer information</h2>
                <p class="b_section_subtitle">Länkar till Transportstyrelsen & Trafikverket</p>
                <div class="b_section_content">
                    <div class="row">
                        <div class="col col-lg-4 col-12">
                            <div class="info-block license flipInY wow" data-wow-duration="1000ms" data-wow-delay="500ms" data-wow-offset="100">
                                <div class="icon license"></div>
                                <h3>Körkortsbehörigheter</h3>
                                <p>I tabellen hos Transportstyrelsen kan du se vilken ålder som krävs för att du ska kunna ta körkort för de olika behörigheterna.</p><a class="btn" href="https://www.transportstyrelsen.se/sv/vagtrafik/Korkort/har-korkort/fordon-du-far-kora/" target="_blank">Besök webbplatsen</a>
                            </div>
                        </div>
                        <div class="col col-lg-4 col-12">
                            <div class="info-block license flipInY wow" data-wow-duration="1000ms" data-wow-delay="400ms" data-wow-offset="100">
                                <div class="icon category"></div>
                                <h3>Körkortstillstånd</h3>
                                <p>Hos Transportstyrelsen kan du ansöka om körkortstillstånd för AM, A1, A2, A, B, BE och traktorkörkort.</p><a class="btn" href="https://etjanst.transportstyrelsen.se/extweb/kktillstgrI" target="_blank">Besök webbplatsen</a>
                            </div>
                        </div>
                        <div class="col col-lg-4 col-12">
                            <div class="info-block license flipInY wow" data-wow-duration="1000ms" data-wow-delay="300ms" data-wow-offset="100">
                                <div class="icon testing"></div>
                                <h3>Boka förarprov</h3>
                                <p>I tjänsten Boka förarprov hos Trafikverket kan du boka och avboka prov för alla körkortsbehörigheter.</p><a class="btn" href="https://fp.trafikverket.se/Boka/#/" target="_blank">Besök webbplatsen</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start CONTACTS section-->
        <section class="b_section section-contact">
            <div class="container">
                <h2 class="b_section_title">Välkommen att kontakta oss</h2>
                <p class="b_section_subtitle">Alla utbildningspaket som köpes via INTENSIVKURS STOCKHOLMS hemsida, utbildas av VÄSTERORT TRAFIKSKOLA i Vällingby</p>
                <div class="b_section_content">
                    <ul class="social-area wow zoomIn" data-wow-duration="1000ms" data-wow-delay="200ms" data-wow-offset="100">
                        <li>
                            <!-- facebook--><a href="https://sv-se.facebook.com/www.vasterorttrafikskola.se/" target="_blank">
                                <div class="icon"><img class="svg" src="assets/images/icon-facebook.svg" alt="facebook Logo"></div><span>fb.com/www.vasterorttrafikskola.se</span></a>
                        </li>
                        <li>
                            <!-- mail--><a href="mailto:info@vasterorttrafikskola.se " target="_blank">
                                <div class="icon"><img class="svg" src="assets/images/icon-mail.svg" alt="mail Logo"></div><span>info@vasterorttrafikskola.se </span></a>
                        </li>
                        <li>
                            <!-- insta--><a href="https://www.instagram.com/vasterorttrafikskola/" target="_blank">
                                <div class="icon"><img class="svg" src="assets/images/insta_normal.svg" alt="mail Logo"></div><span>vasterorttrafikskola</span></a>
                        </li>
                        <li>
                            <!-- phone--><a href="tel:0853330101" target="_blank">
                                <div class="icon"><img class="svg" src="assets/images/phone_normal.svg" alt="mail Logo"></div><span>08-533 301 01</span></a>
                        </li>
                    </ul>
                    <form id="contact-form" class="wow zoomIn" action="#" method="POST" data-wow-duration="1000ms" data-wow-delay="200ms" data-wow-offset="100">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Namn" required>
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="Telefonnummer" required pattern="^[_A-z0-9]{1,}$">
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email Adress" required data-error="Email address is invalid">
                            <div class="help-block"></div>
                        </div>
                        <textarea placeholder="Skriv ditt meddelande här" name="message" required></textarea>
                        <input class="btn-blue" type="submit" value="SKICKA">
                    </form>
                </div>
            </div>
        </section>
        <section class="copyright">
            <div class="container">
                <div class="col col-md-5 col-sm-12 col-12">
                    <p>Copyright &#169; 2018 INTENSIVKURS STOCKHOLM</p>
                    <p>All rättigheter förbehålls.</p>
                </div>
                <div class="col col-md-2 col-sm-12 col-12">
                    <a class="footer_logo" href="#">
                        <img src="assets/images/logo.png" alt="Intensivkurs Logo">
                    </a>
                </div>
                <div class="col col-md-5 col-sm-12 col-12 last">
                    <p>INTENSIVKURS STOCKHOLM i samarbete med</p>
                    <p>VÄSTERORT TRAFIKSKOLA i Vällingby - Grimsta </p>
                </div>
            </div>
        </section>
    </div>
    <!-- start ADS modal-->
    <div class="modal fade" id="ads-modal" tabindex="-1" role="dialog" aria-labelledby="ads" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"></button>
                    <h4 class="modal-title">VÄLKOMMEN</h4>
                    <p>EXKLUSIVA ERBJUDANDEN FRÅN INTENSIVKURS STOCKHOLM</p>
                </div>
                <div class="modal-body">
                    <h2>KÖP 3 KÖRLEKTIONER OCH FÅ <span>50%</span> RABATT</h2>
                    <p>NU FÖR ENDAST <span>1100:-</span> HOS VÄSTERORT TRAFIKSKOLA</p>
                    <form class="flex flex-between" action="/offer-discount" method="POST" id="ads-modal-form">
                        <input type="text" name="phone" placeholder="Skriv in ditt mobilnummer här" required>
                        <input class="btn-blue" type="submit" value="SKICKA" onclick="">
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Genom att fylla i ditt mobilnummer godkänner du samtidigt att ta del av Västerort trafikskolas kampanjer. Du kan närsomhelst avregistrera dig från denna tjänst genom ett enkelt sms (Avregistrera mig). Erbjudandet gäller endast nya elever samt folkbokförda utanför Västerort. </p>
                </div>
            </div>
        </div>
    </div>
    <!-- start FORM modal-->
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="form" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"></button>
                    <h4 class="modal-title">KONTAKTA OSS</h4>
                    <p>Har du några frågor och funderingar kring våra paket och priser, så är du välkommen att kontakta oss.</p>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Namn" required>
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email Adress" required data-error="Email address is invalid">
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Telefonnummer" required pattern="^[_A-z0-9]{1,}$">
                            <div class="help-block"></div>
                        </div>
                        <textarea type="text" name="message" placeholder="Meddelande"></textarea>
                        <input class="btn-blue" type="submit" value="SKICKA">
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <!-- start PACKET modal-->
    <div class="modal fade" id="packet-modal" tabindex="-1" role="dialog" aria-labelledby="form" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"></button>
                    <h4 class="modal-title">{{namePacket}} (<span v-html="pricePacket"></span>)</h4>
                </div>
                <div class="modal-body">
                    <form id="packet-form" action="#" method="post">
                        <input type="hidden" name="pack_id" v-model="packId" readonly="true">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Namn" required>
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email Adress" required data-error="Email address is invalid">
                            <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Telefonnummer" required pattern="^[_A-z0-9]{1,}$">
                            <div class="help-block"></div>
                        </div>
                        <input type="text" name="discount_code" placeholder="Rabattkod">
                        <input class="btn-blue" type="submit" value="SKICKA">
                    </form>
                    <div class="response-message">
                        <h4>Tack för visat intresse, vi kommer att kontakta dig så fort vi kan!</h4>
                        <button class="btn-blue" type="button" data-dismiss="modal">OK</button>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- start Info modal-->
    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="form" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"></button>
                    <h4 class="modal-title">Här kan du läsa om Intensivkurs Stockholm integritetspolicy (GDPR).</h4>
                </div>
                <div class="modal-body">
                    <h3>INSAMLING OCH BEHANDLING AV PERSONUPPGIFTER</h3>
                    <p>För att kunna erbjuda dig våra tjänster behöver vi behandla dina personuppgifter. Du kan direkt eller indirekt komma att ge oss information om dig själv genom att maila, ringa eller besöka oss.</p>
                    <p>Ändamålet med behandlingen av dina uppgifter är för att säkerställa vem du är, kunna kontakta dig och att administrera din utbildning och dina köp hos oss. För ovan syfte samlar Intensivkurs Stockholm in namn, adress, mobilnummer, e-postadress och personnummer.</p>
                    <h3>SAMTYCKE TILL BEHANDLING</h3>
                    <p>Genom att använda någon utav Intensivkurs Stockholm tjänster accepterar du vår integritetspolicy och vår behandling av dina personuppgifter såsom de framgår nedan. När du skriver in dig på Västerort Trafikskola samtycker du till dessa villkor och att du ger Intensivkurs Stockholm rätt att behandla dina personuppgifter, utbildningskort och köpinformation i enlighet med dessa villkor. Du samtycker även till att ta emot direktmarknadsföring från Intensivkurs Stockholm och Västerort Trafikskola via e-post och sms. Du har när som helst rätt att avsluta ditt medlemskap och återkalla dina samtycken.</p>
                    <h3>VEM KAN FÅ DEL AV DIN INFORMATION?</h3>
                    <p>Dina uppgifter lagras genom ett slutet system som är utvecklat av en betrodd tredje part Trafikutbildningarnas riksorganisation. Intensivkurs Stockholm säljer leads som kan innehålla information om dig till någon annan men i vissa fall behöver vi dela information med en annan, för att kunna erbjuda tjänsterna lokalt.</p>
                    <h3>Leverantörer och underleverantörer</h3>
                    <p>Vi kan komma att dela din information med leverantörer eller underleverantörer (tex e-post, teleoperatör, finansieringspartners, kreditupplysningsföretag, faktureringspartners, Trafikskolor) för utförandet av våra tjänster gentemot dig.</p>
                    <h3>Målsman</h3>
                    <p>Om eleven är under 18 år kan målsman komma att kontakta Västerort Trafikskola eller Intensivkurs Stockholm för att utföra ärenden för elevens räkning. Om eleven är myndig måste eleven ge sitt samtycke till Intensivkurs Stockholm att tredje part utför ärende för elevens räkning.</p> 
                    <h3>Myndigheter</h3>
                    <p>Vi är skyldiga att rapportera viss genomförd utbildning till Transportstyrelsen, det gäller tex Introduktionsutbildning och Riskutbildning. För bokning av förarprov behöver vi dela information med Trafikverket.</p>    
                    <p>I annat fall kommer Intensivkurs Stockholm inte att lämna ut dina uppgifter till tredje part, om detta inte är nödvändigt till följd av en lagstadgad skyldighet, tex Skatteverket.</p>
                    <h3>HUR LÄNGE SPARAR VI DIN INFORMSTION?</h3>
                    <p>Vi behandlar bara din information så länge som det krävs enligt lag eller annars så länge vi har ett berättigat intresse eller som vi behöver den för att kunna utföra våra tjänster mot dig.</p>
                    <h3>DINA RÄTTIGHETER</h3>
                    <p>Du kan när som helst skriva till Intensivkurs Stockholm och begära att dina personuppgifter rättas, tas bort eller för att återkalla dina samtycken. Du har även rätt att en gång per år begära information om vilka uppgifter om dig som vi behandlar.</p>
                    <h3>VILLKORSÄNDRINGAR</h3>
                    <p>Intensivkurs Stockholm förbehåller sig rätten att ändra innehållet i integritetspolicyn med beaktande av dina rättigheter enligt gällande lagar och regler. Vi betydande förändringar kommer vi att meddela dig via e-post eller via telefon.</p>
                    <h3>KONTAKT</h3>
                    <p>Om du inte är nöjd med vår hantering av dina personuppgifter eller om du har några frågor om Intensivkurs Stockholm eller Västerort Trafikskolas behandling av personuppgifter ber vi dig att kontakta oss.</p>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="thank-modal" tabindex="-1" role="dialog" aria-labelledby="form" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h4>Tack för visat intresse, vi kommer att kontakta dig så fort vi kan!</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn-blue" type="button" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <!-- start LOADER-->
    <div class="loader bounceOutRight">
        <div class="icon"></div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcQed-XICEOIuLN8MHRzJ2GtX6D8g8IXs"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.2.0/vue-resource.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="assets/js/libs.js"></script>
<script src="https://unpkg.com/vue@2.4.2/dist/vue.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/contact-form.js"></script>
<script src="assets/js/packet-form.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.car-block [name=license]').on('change', function() {
            let checval = $('.car-block [name=license]:checked').val();
            if (checval) {
                $('#car-licence').text(checval.toUpperCase());
                $('.scooter-block .wrap-btn, .bike-block .wrap-btn').removeClass('checked');
                $('.car-block .wrap-btn').addClass('checked');
                $('#scooter-licence').text('AM');
                $('#bike-licence').text('A');
            } else {
                $('#car-licence').text('B');
            }
        });

        $('.bike-block [name=license]').on('change', function() {
            let checval = $('.bike-block [name=license]:checked').val();
            if (checval) {
                $('#bike-licence').text(checval.toUpperCase());
                $('.car-block .wrap-btn, .scooter-block .wrap-btn').removeClass('checked');
                $('.bike-block .wrap-btn').addClass('checked');
                $('#car-licence').text('B');
                $('#scooter-licence').text('AM');
            } else {
                $('#bike-licence').text('A');
            }
        });

        $('.scooter-block [name=license]').on('change', function() {
            let checval = $('.scooter-block [name=license]:checked').val();
            if (checval) {
                $('#scooter-licence').text(checval.toUpperCase());
                $('.car-block .wrap-btn, .bike-block .wrap-btn').removeClass('checked');
                $('.scooter-block .wrap-btn').addClass('checked');
                $('#bike-licence').text('A');
                $('#car-licence').text('B');
            } else {
                $('#scooter-licence').text('AM');
            }
        });

        $('#ads-modal-form').submit(function(e) {
            e.stopPropagation();

            $.post(
                $(this).attr("action"),
                $(this).serialize()
            );

            $("#ads-modal").modal("hide");
            setTimeout(showThankPopup, 500);

            return false;
        });

        $("li.info-item").click(showTitle);
        $("li.info-item").hover(showTitle, hideTitle);

        $("body").click(hideTitle);
    });

    function showThankPopup() {
        $('#thank-modal').modal('show');
    }

    function hideTitle() {
        $("span.title").remove();
    }

    function showTitle(e) {
        e.stopPropagation();
        var $title = $(this).find(".title");
        if (!$title.length) {
            $(this).append('<span class="title">' + $(this).data("title") + '</span>');
        } else {
            $title.remove();
        }
    }
</script>
</body>
</html>
