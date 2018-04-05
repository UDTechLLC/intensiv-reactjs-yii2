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
    <title>vasterorttrafikskola.se</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="assets/css/libs.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<div class="page" id="app">
    <!-- block HEADER-->
    <div class="header flex">
        <div class="map" id="map-layout">
            <!--img(src="" + imagePath + "map.jpg", alt="map")-->
        </div>
        <div class="filter-section">
            <div class="flex flex-center header-filter"><a class="b_logo" href="#"><img src="assets/images/logo.svg" alt="Intensivkurs Logo"></a></div>
            <div class="body">
                <form method="POST" action="#" v-on:submit.prevent="openSchoolView">
                    <div class="drive">
                        <h3>Fordonsbehörighet</h3>
                        <div class="section flex">
                            <div class="button-license b">
                                <input type="radio" name="license" value="b" v-model="pickedLicense" v-on:change="changeLicense">
                                <div class="wrap-btn">
                                    <div class="icon"><img class="svg" src="https://projects.udtech.co/intensivkurs/assets/images/b.svg" alt="B Logo"></div>B
                                </div>
                                <div class="dropdown animated fadeIn">
                                    <input type="radio" name="license" value="ub" id="license-ub" v-model="pickedLicense" v-on:change="changeLicense">
                                    <label for="license-ub"><span>UB</span>Bil + Släpvagn (Max 4.25 ton)</label>
                                    <input type="radio" name="license" value="be" id="license-be" v-model="pickedLicense" v-on:change="changeLicense">
                                    <label for="license-be"><span>BE</span>Tung släpvagn (Max 3.5 ton)</label>
                                </div>
                            </div>
                            <div class="button-license a">
                                <input type="radio" name="license" value="a" v-model="pickedLicense" v-on:change="changeLicense">
                                <div class="wrap-btn">
                                    <div class="icon"><img class="svg" src="https://projects.udtech.co/intensivkurs/assets/images/a.svg" alt="A Logo"></div>A
                                </div>
                                <div class="dropdown animated fadeIn">
                                    <input type="radio" name="license" value="a1" id="license-a1" v-model="pickedLicense" v-on:change="changeLicense">
                                    <label for="license-a1"><span>A1</span>Lätt motorcykel (Max 11 Kw)</label>
                                    <input type="radio" name="license" value="a2" id="license-a2" v-model="pickedLicense" v-on:change="changeLicense">
                                    <label for="license-a2"><span>A2</span>Mellanstor motorcykel (Max 35 Kw)</label>
                                </div>
                            </div>
                            <div class="button-license am">
                                <input type="radio" name="license" value="am" v-model="pickedLicense" v-on:change="changeLicense">
                                <div class="wrap-btn">
                                    <div class="icon"><img class="svg" src="https://projects.udtech.co/intensivkurs/assets/images/am.svg" alt="AM Logo"></div>AM
                                </div>
                                <div class="dropdown animated fadeIn">
                                    <input type="radio" name="license" value="am-45" id="license-am-1" v-model="pickedLicense" v-on:change="changeLicense">
                                    <label for="license-am-1"><span>Klass 1</span>, Körkort 45 km/h</label>
                                    <input type="radio" name="license" value="am-25" id="license-am-2" v-model="pickedLicense" v-on:change="changeLicense">
                                    <label for="license-am-2"><span>Klass 2</span>, Förarbevis 25 km/h  </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="home">
                        <h3>Medlem</h3>
                        <div class="section">
                            <select2 class="select-contain" name="search_area_map" v-model="selectPlace">
                                <option disabled selected value="placeholder">Välj ort</option>
                                <option v-for="place in listPlaces" :value="place.id">{{place.city}}</option>
                            </select2>
                            <select2 class="select-contain" name="search_name" v-model="selectSchool">
                                <option disabled selected value="placeholder">Välj trafikskola</option>
                                <option v-for="school in listSchools" :value="school.id">{{school.name}}</option>
                            </select2>
                            <script type="text/x-template" id="select2-template">
                                <select>
                                    <slot></slot>
                                </select>
                            </script>
                        </div>
                    </div>
                    <input class="btn-blue" type="submit" value="Se omdöme">
                </form>
            </div>
        </div>
        <div class="school-view">
            <button class="close" @click="closeSchoolView"><span class="icon"><img class="svg" src="assets/images/arrow-down.svg" alt="arrow"></span></button>
            <h2>Intensivkurs Stockholm</h2>
            <p class="description">Kvalitet och miljö TA-2017</p>
            <div class="graph"></div>
            <div class="table-statistic">
                <div class="row">
                    <div class="col col-sm-5">
                        <p class="label">Kundsupport</p>
                    </div>
                    <div class="col col-sm-7">
                        <div class="block-statistic">
                            <div class="progress-bar support" style="width:85%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-5">
                        <p class="label">Lärarlegitimation</p>
                    </div>
                    <div class="col col-sm-7">
                        <div class="block-statistic">
                            <div class="progress-bar registrationTeacher" style="width:100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-5">
                        <p class="label">Pedagogik</p>
                    </div>
                    <div class="col col-sm-7">
                        <div class="block-statistic">
                            <div class="progress-bar pedagogical" style="width:95%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-5">
                        <p class="label">Miljöfordon</p>
                    </div>
                    <div class="col col-sm-7">
                        <div class="block-statistic">
                            <div class="progress-bar cleanVehicles" style="width:90%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-5">
                        <p class="label">Rekommendation</p>
                    </div>
                    <div class="col col-sm-7">
                        <div class="block-statistic">
                            <div class="progress-bar recommendation" style="width:95%;"></div>
                        </div>
                    </div>
                </div>
            </div>
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
                <h2 class="b_section_title">Välj mellan olika körpaket</h2>
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
                                    <div class="icon <?=$pack->image;?>"></div>
                                    <h3><?=$pack->name;?></h3>
                                    <div class="price"><?=$pack->price_formatted;?></div>
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
                                    <button
                                        class="btn btn-blue btn-small"
                                        @click="openModalPacket('<?=$pack->name;?>',
                                                                '<?=$pack->price_formatted;?>',
                                                                <?=$pack->id;?>)"
                                        data-target="#packet-modal"
                                        data-toggle="modal"
                                    >Boka nu</button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- start school inform section-->
        <section class="b_section regions b_section-colored">
            <div class="container">
                <h2 class="b_section_title">Välkommen till västerort trafikskola</h2>
                <p class="b_section_subtitle">Här är våra övningsområden i Västerort</p>
                <div class="b_section_content">
                    <div class="row">
                        <div class="col col-lg-4 col-12">
                            <div class="info-block license flipInY wow" data-wow-duration="1000ms" data-wow-delay="500ms" data-wow-offset="100">
                                <div class="icon hasselby"></div>
                                <h3>Hässelby</h3>
                                <p>Hässelby är ett område i Västerort i Stockholms kommun, vilket omfattar stadsdelarna Hässelby gård, Hässelby strand och Hässelby villastad. Stadsdelen har många bra övningsområden för tätort, cirkulationsplatser och vägar med dubbelkörfält.</p>
                            </div>
                        </div>
                        <div class="col col-lg-4 col-12">
                            <div class="info-block license flipInY wow" data-wow-duration="1000ms" data-wow-delay="400ms" data-wow-offset="100">
                                <div class="icon bromma"></div>
                                <h3>Bromma</h3>
                                <p>Bromma är en närförort inom Västerort i Stockholms kommun med ett läge intill Stockholms innerstad. Stadsdelen är känd för att ha en komplex trafik med högt tempo. Trafikområdet är utmärkt för att testa kunskaper och förmågor.</p>
                            </div>
                        </div>
                        <div class="col col-lg-4 col-12">
                            <div class="info-block license flipInY wow" data-wow-duration="1000ms" data-wow-delay="300ms" data-wow-offset="100">
                                <div class="icon spanga"></div>
                                <h3>Spånga</h3>
                                <p>Spånga är samlingsnamnet för stadsdelarna inom Spånga-Tensta stadsdelsområde i Västerort inom Stockholms kommun. Spånga har många bra övningsområden för nybörjare. Trafikområdet erbjuder stora körfält med många trafikljuskorsningar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start MY MOVEMENT section-->
        <section class="b_section traffic">
            <div class="container">
                <h2 class="b_section_title">MITT I TRAFIKEN</h2>
                <p class="b_section_subtitle">Att köra bil kräver kunskap och skicklighet. Därför har vi valt att öka förståelsen för vissa trafiksituationer med hjälp av Transportstyrelsens informationsfilmer</p>
                <div class="b_section_content">
                    <div class="row">
                        <div class="col col-md-4 col-12">
                            <div style="max-width: 370px; max-height: 256px">
                            <iframe width="100%" height="100%" frameBorder="0"
                                    src="https://www.youtube.com/embed/M75DVzrVlZs">
                            </iframe>
                            </div>
                            <p>Ska man köra motsols? Vem har väjningsplikt? När ska man blinka i cirkulationsplatsen?</p>
                        </div>
                        <div class="col col-md-4 col-12">
                            <div style="max-width: 370px; max-height: 256px">
                            <iframe width="100%" height="100%" frameBorder="0"
                                    src="https://www.youtube.com/embed/pe2lq1ZZ4Sk">
                            </iframe>
                            </div>
                            <p>Vem är en gående? Vem är en fordonsförare? Bevakat eller obevakat övergångsställe?</p>
                        </div>
                        <div class="col col-md-4 col-12">
                            <div style="max-width: 370px; max-height: 256px">
                            <iframe width="100%" height="100%" frameBorder="0"
                                    src="https://www.youtube.com/embed/VLVQIO9aIqM">
                            </iframe>
                            </div>
                            <p>Vem är cyklande? Vad är en cykelpassage? Vad är en cykelöverfart? Bevakad eller obevakad?</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start MER INFORMATION section-->
        <section class="b_section b_section-colored more-inform">
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
                <p class="b_section_subtitle">Kontakta oss gärna vid frågor om körkort, övningspaket eller övriga tjänster.</p>
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
    </div>
    <!-- start ADS modal-->
    <div class="modal fade" id="ads-modal" tabindex="-1" role="dialog" aria-labelledby="ads" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"></button>
                    <h4 class="modal-title">VÄLKOMMEN</h4>
                    <p>SOM NY BESÖKARE GER VI DIG IDAG</p>
                </div>
                <div class="modal-body">
                    <h2><span>40%</span>RABATT</h2>
                    <p>PÅ DITT KÖP AV HANDLEDARKURSEN</p>
                    <form class="flex flex-between" action="/offer-discount" method="POST">
                        <input type="text" name="phone" placeholder="Skriv in ditt mobilnummer här" required>
                        <input class="btn-blue" type="submit" value="SKICKA" onclick="">
                    </form>
                </div>
                <div class="modal-footer">
                    <p>Genom att fylla i ditt mobilnummer godkänner du samtidigt att du får ta del av Västerort trafikskolas kampanjer. Du kan närsomhels avregistrera dig från denna tjänst genom ett enkel sms (Avregistrera mig).</p>
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
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <!-- start LOADER-->
    <div class="loader bounceOutRight">
        <div class="icon"></div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcQed-XICEOIuLN8MHRzJ2GtX6D8g8IXs"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="assets/js/libs.js"></script>
<script src="https://unpkg.com/vue@2.4.2/dist/vue.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/contact-form.js"></script>
<script src="assets/js/packet-form.js"></script>
</body>
</html>
