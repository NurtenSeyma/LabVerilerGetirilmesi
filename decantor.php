<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    include("../../settings.php");
    
    authority();
    //
    $date = date("d.m.Y H:i:s", $_POST["id"]);
    $sql = oci_parse($ORACLEconnection, "SELECT * FROM HAKASAPLAB WHERE BREAKDOWNNUM='".strip_tags($_POST["breakdownnum"])."'");
    oci_execute($sql);
    $service = oci_fetch_array($sql, OCI_ASSOC+OCI_RETURN_LOB);
    //


    	$test = array();

	$result = oci_parse($ORACLEconnection, "SELECT COL,VAL FROM HAKASAPLAB WHERE BREAKDOWNNUM='".strip_tags($_POST["breakdownnum"])."'");
	oci_execute($result);
	while($breakdowns = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS))
	{

			//print_r($breakdowns);
		
			array_push($test, $breakdowns);

	}

	//print_r($test);
	//$model ="";
	

	foreach ($test as $key => $value)
	{
		
		if($value["COL"]=="MODEL") { $model = $value["VAL"]; }
		elseif($value["COL"]=="SERINUMARASI") { $seriNo = $value["VAL"]; }
		elseif($value["COL"]=="CALISMASAATI") { $calismasaati = $value["VAL"]; }
	}
	



  
?>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<div class="row">
    <div class="col-xl-3">
        <div class="table-container pt-3 pb-3">
            <ul class="nav flex-column" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general-container" role="tab" aria-controls="general-container" aria-selected="true"><i class="fad fa-file-alt"></i> Genel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="motor-tab" data-toggle="tab" href="#motor-container" role="tab" aria-controls="motor-container" aria-selected="false"><i class="fad fa-file-alt"></i> Motor Bilgileri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="machine-tab" data-toggle="tab" href="#machine-container" role="tab" aria-controls="machine-container" aria-selected="false"><i class="fad fa-file-alt"></i> Makina Bilgileri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sample-tab" data-toggle="tab" href="#sample-container" role="tab" aria-controls="sample-container" aria-selected="false"><i class="fad fa-file-alt"></i> Ürün & Numune Bilgisi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-pump-tab" data-toggle="tab" href="#product-pump-container" role="tab" aria-controls="product-pump-container" aria-selected="false"><i class="fad fa-file-alt"></i> Ürün Pompa Bilgileri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="polymer-tab" data-toggle="tab" href="#polymer-container" role="tab" aria-controls="polymer-container" aria-selected="false"><i class="fad fa-file-alt"></i> Polimer Bilgileri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="energy-tab" data-toggle="tab" href="#energy-container" role="tab" aria-controls="energy-container" aria-selected="false"><i class="fad fa-file-alt"></i> Enerji Sarfiyat Bilgileri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="perfomance-tab" data-toggle="tab" href="#perfomance-container" role="tab" aria-controls="perfomance-container" aria-selected="false"><i class="fad fa-file-alt"></i> Dekantör Performansı</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="finish-tab" data-toggle="tab" href="#finish-container" role="tab" aria-controls="finish-container" aria-selected="false"><i class="fad fa-file-alt"></i> Formu Tamamla</a>
                </li>
            </ul>

        </div>
    </div>




<div class="col-xl-9">

	<form id="<?php echo $_POST["id"]=="" ? "new" : "edit";?>" name="form" method="post" action="javascript:void(0);">
	<input type="hidden" id="TYPE" name="TYPE" value="1">
	<input type="hidden" id="BREAKDOWNNUM" name="BREAKDOWNNUM" value="<?php echo $_POST["breakdownnum"];?>">
	<input type="hidden" id="CREATEDAT" name="CREATEDAT" value="<?php echo $service["CREATEDAT"];?>">
	
        <div class="table-container p-4">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="general-container" role="tabpanel" aria-labelledby="general-tab">

                
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Makina Modeli</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="MODEL" name="MODEL" value="<?php echo $model;?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Seri Numarası</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control"  id="SERINUMARASI" name="SERINUMARASI" value="<?php echo $seriNo;?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Çalışma Saati <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control required" id="CALISMASAATI" name="CALISMASAATI" value="<?php echo $calismasaati;?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Çalışma Devri <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control required" id="CALISMADEVRI" name="CALISMADEVRI" value="<?php echo $service["CALISMADEVRI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Çalışma Fazı</label></div>
                    	<div class="col-xl-6 pt-2">
						<input type="radio" id="radio1" name="FAZ" class="toggle" value="2" <?php echo $service["FAZ"]=="2" ? "checked" : ""; ?>>
						<label for="radio1">2 Faz</label>
						
						<input type="radio" id="radio2" name="FAZ" class="toggle" value="3" <?php echo $service["FAZ"]=="3" ? "checked" : ""; ?>>
						<label for="radio2">3 Faz</label>
                    	</div>
                    </div>

                    



                </div>

                <div class="tab-pane" id="motor-container" role="tabpanel" aria-labelledby="motor-tab">

                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Motor Bilgisi</label></div>
                    	<div class="col-xl-6 pt-2">
						<input type="radio" id="radio3" name="MOTOR" class="toggle" value="1" <?php echo $service["MOTOR"]=="1" ? "checked" : ""; ?>>
						<label for="radio3">Tek Motor</label>
						
						<input type="radio" id="radio4" name="MOTOR" class="toggle" value="2" <?php echo $service["MOTOR"]=="2" ? "checked" : ""; ?>>
						<label for="radio4">Çift Motor</label>
                    	</div>
                    </div>
                    <!-- SINGLE MOTOR ALANI -->
                    <div class="single-motor-alanlari hide">
                         <div class="row">
                            <div class="col-xl-6"><label for="" class="input-label">Tambur Devri <span class="badge badge-pill badge-warning">%</span></label></div>
                            <div class="col-xl-6"><input type="text" class="form-control" id="TAMBURDEVRIYUZDE" name="TAMBURDEVRIYUZDE" value="<?php echo $service["TAMBURDEVRIYUZDE"];?>"></div>
                        </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Kayış - Kasnak - Diferansiyel Hız</label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="KAYISKASNAKDIFHIZ" name="KAYISKASNAKDIFHIZ" value="<?php echo $service["KAYISKASNAKDIFHIZ"];?>"></div>
	                    </div>
                        <div class="row">
                            <div class="col-xl-6"><label for="" class="input-label">Besleme Borusu Seviyesi <span class="badge badge-pill badge-warning">%</span></label></div>
                            <div class="col-xl-6"><input type="text" class="form-control" id="BESLEMEBORUSUSEVIYESI" name="BESLEMEBORUSUSEVIYESI" value="<?php echo $service["BESLEMEBORUSUSEVIYESI"];?>"></div>
                        </div>
	                    <!-- BEK AYARI ALANI -->
	                    <div class="bek-ayari-alanlari hide">
		                    <div class="row">
		                    	<div class="col-xl-6"><label for="" class="input-label">Bek Ayarı <span class="badge badge-pill badge-warning">Yağ Çıkışı</span></label></div>
		                    	<div class="col-xl-6"><input type="text" class="form-control"  id="BEKAYARI" name="BEKAYARI" value="<?php echo $service["BEKAYARI"];?>"></div>
		                    </div>
		                </div>
		                <!-- BEK AYARI ALANI -->
	                </div>
	                <!-- SINGLE MOTOR ALANI -->
	                <!-- DUAL MOTOR ALANI -->
                    <div class="dual-motor-alanlari hide">

	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Diferansiyel Hız <span class="badge badge-pill badge-warning">Alt Sınır / Üst Sınır / Aktüel </span> <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
	                    	<div class="col-xl-6 input-group">
	                    		<input type="number" class="form-control" id="ALTSINIRDIFHIZRPM" name="ALTSINIRDIFHIZRPM" placeholder="Alt Sınır" value="<?php echo $service["ALTSINIRDIFHIZRPM"];?>">
	                    		<input type="number" class="form-control" id="USTSINIRDIFHIZRPM" name="USTSINIRDIFHIZRPM" placeholder="Üst Sınır" value="<?php echo $service["USTSINIRDIFHIZRPM"];?>">
	                    		<input type="number" class="form-control" id="AKTUELDIFHIZRPM"  name="AKTUELDIFHIZRPM" placeholder="Aktüel" value="<?php echo $service["AKTUELDIFHIZRPM"];?>">
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Helezon Motor Hızı <span class="badge badge-pill badge-warning">RPM</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="HELEZONMOTORHIZIRPM" name="HELEZONMOTORHIZIRPM" value="<?php echo $service["HELEZONMOTORHIZIRPM"];?>"></div>
	                    </div>


	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Aktuel Tork Değeri <span class="badge badge-pill badge-warning">% </span> <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="AKTUELTORKDEGERI" name="AKTUELTORKDEGERI" placeholder="%" value="<?php echo $service["AKTUELTORKDEGERI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Regülasyon Başlangıç Torku <span class="badge badge-pill badge-warning">%</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="REGULASYONBASLANGICTORKU" name="REGULASYONBASLANGICTORKU" placeholder="%" value="<?php echo $service["REGULASYONBASLANGICTORKU"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Pompaları Kapatma Torku <span class="badge badge-pill badge-warning">%</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POMPALIKAPATMATORKU" name="POMPALIKAPATMATORKU" placeholder="%" value="<?php echo $service["POMPALIKAPATMATORKU"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Dekantörü Kapatma Torku <span class="badge badge-pill badge-warning">%</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="DEKANTORUKAPATMATORKU" name="DEKANTORUKAPATMATORKU" placeholder="%" value="<?php echo $service["DEKANTORUKAPATMATORKU"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Vibrasyon Değeri <span class="badge badge-pill badge-warning">mm/sn</span> <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="VIBRASYONDEGERI" name="VIBRASYONDEGERI" placeholder="mm/sn" value="<?php echo $service["VIBRASYONDEGERI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Besleme Borusu Seviyesi <span class="badge badge-pill badge-warning">%</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="BESLEMEBORUSUSEVIYESIIKI" name="BESLEMEBORUSUSEVIYESIIKI" placeholder="%" value="<?php echo $service["BESLEMEBORUSUSEVIYESIIKI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Yatak Sıcaklığı <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
	                    	<div class="col-xl-6 input-group">
	                    		<input type="number" class="form-control" id="YATAKSICAKLIKURUN" name="YATAKSICAKLIKURUN" placeholder="Ürün Tarafı" value="<?php echo $service["YATAKSICAKLIKURUN"];?>">
	                    		<input type="number" class="form-control" id="YATAKSICAKLIKSANZUMAN" name="YATAKSICAKLIKSANZUMAN" placeholder="Şanzuman Tarafı" value="<?php echo $service["YATAKSICAKLIKSANZUMAN"];?>">
	                    	</div>
	                    </div>
	                </div>
	                <!-- DUAL MOTOR ALANI -->
                </div>

                <div class="tab-pane" id="machine-container" role="tabpanel" aria-labelledby="machine-tab">
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Sıvı Çıkış Kapak Ayarı <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="SIVICIKISKAPAKAYARI" name="SIVICIKISKAPAKAYARI" placeholder="" value="<?php echo $service["SIVICIKISKAPAKAYARI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Tambur Devri <span class="badge badge-pill badge-warning">%</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="TAMBURDEVRIIKI" name="TAMBURDEVRIIKI" placeholder="%" value="<?php echo $service["TAMBURDEVRIIKI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Besleme Borusu Seviyesi</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="BESLEMEBORUSUSEVIYESIUC" name="BESLEMEBORUSUSEVIYESIUC" value="<?php echo $service["BESLEMEBORUSUSEVIYESIUC"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Su besleme debisi</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="SUBESLEMEDEBISI" name="SUBESLEMEDEBISI" value="<?php echo $service["SUBESLEMEDEBISI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Maksimum Helezon Aşınması <span class="badge badge-pill badge-danger">Zorunlu Alan</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="MAXHELEZONASINMA" name="MAXHELEZONASINMA" value="<?php echo $service["MAXHELEZONASINMA"];?>"></div>
                    </div>

                </div>

                <div class="tab-pane" id="sample-container" role="tabpanel" aria-labelledby="sample-tab">
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Genel Proses Bilgisi</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="GENELPROSESBILGISI" name="GENELPROSESBILGISI" value="<?php echo $service["GENELPROSESBILGISI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Ekipmana Beslenen Ürünün Adı</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="EKIPMANABESLENENURUN" name="EKIPMANABESLENENURUN" value="<?php echo $service["EKIPMANABESLENENURUN"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Toplam Katı Madde <span class="badge badge-pill badge-warning">%</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control"  id="TOPLAMKATIMADDE" name="TOPLAMKATIMADDE" placeholder="%" value="<?php echo $service["TOPLAMKATIMADDE"];?>"></div>
                    </div>

                      <div class="row">
                        <div class="col-xl-6"><label for="" class="input-label">Müşteri Lab. Alınan Performans Bilgileri (NTU - FFA - PPM)</div>
                        <div class="col-xl-6"><input type="text" class="form-control" id="MUSPERBILGILERI" name="MUSPERBILGILERI" value="<?php echo $service["MUSPERBILGILERI"];?>"></div>
                    </div>

                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Laboratuvarda Incelenmesi Için Numune Alındı mı?</label></div>
                    	<div class="col-xl-6 pt-2">
						<input type="radio" id="radio5" name="NUMUNE" class="toggle" value="Evet" <?php echo $service["NUMUNE"]=="Evet" ? "checked" : ""; ?>>
						<label for="radio5">Evet</label>
						
						<input type="radio" id="radio6" name="NUMUNE" class="toggle" value="Hayır" <?php echo $service["NUMUNE"]=="Hayır" ? "checked" : ""; ?>>
						<label for="radio6">Hayır</label>
                    	</div>
                    </div>
                    <!-- NUMUNE ALANLARI -->
                    <div class="numune-alanlari hide">
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Neden Numune Alınmadı?</label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="NUMUNEALANMADI" name="NUMUNEALANMADI" value="<?php echo $service["NUMUNEALANMADI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Santrifüj sonrası Hacimsel Oranları</label></div>
	                    	<div class="col-xl-6 input-group">
	                    		<input type="number" class="form-control" id="SANTSONHACORANKATI" name="SANTSONHACORANKATI" placeholder="Katı %" value="<?php echo $service["SANTSONHACORANKATI"];?>">
	                    		<input type="number" class="form-control" id="SANTSONHACORANSIVI" name="SANTSONHACORANSIVI" placeholder="Sıvı %" value="<?php echo $service["SANTSONHACORANSIVI"];?>">
	                    		<input type="number" class="form-control" id="SANTSONHACORANYAG" name="SANTSONHACORANYAG" placeholder="Yağ %" value="<?php echo $service["SANTSONHACORANYAG"];?>">
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">pH seviyesi</label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="PHSEVIYESI"  name="PHSEVIYESI" value="<?php echo $service["PHSEVIYESI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Yoğunluğu <span class="badge badge-pill badge-warning">g/ml</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="YOGUNLUGU" name="YOGUNLUGU" placeholder="g/ml" value="<?php echo $service["YOGUNLUGU"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Askıda Katı Madde <span class="badge badge-pill badge-warning">mg/L</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="ASKIDAKATIMADDE" name="ASKIDAKATIMADDE" placeholder="mg/L" value="<?php echo $service["ASKIDAKATIMADDE"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Işleme Sıcaklığı <span class="badge badge-pill badge-warning">°C</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="ISLEMESICAKLIGI" name="ISLEMESICAKLIGI" placeholder="°C" value="<?php echo $service["ISLEMESICAKLIGI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Organik Madde Miktarı <span class="badge badge-pill badge-warning">%</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="ORGANIKMADDEMIKTARI" name="ORGANIKMADDEMIKTARI" placeholder="%" value="<?php echo $service["ORGANIKMADDEMIKTARI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Çamur Hacim Indeksi <span class="badge badge-pill badge-warning">g/ml</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="CAMURHACIMINDEKSI" name="CAMURHACIMINDEKSI" placeholder="g/ml" value="<?php echo $service["CAMURHACIMINDEKSI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Diğer Bilgiler</label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="DIGERBILGILER"  name="DIGERBILGILER" value="<?php echo $service["DIGERBILGILER"];?>"></div>
	                    </div>
	                </div>





                </div>

                <div class="tab-pane" id="product-pump-container" role="tabpanel" aria-labelledby="product-pump-tab">

                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Pompa HAUS tarafından mı verildi?</label></div>
                    	<div class="col-xl-6 pt-2">
						<input type="radio" id="radio7" name="POMPA" class="toggle" value="Evet" <?php echo $service["POMPA"]=="Evet" ? "checked" : ""; ?>>
						<label for="radio7">Evet</label>
						
						<input type="radio" id="radio8" name="POMPA" class="toggle" value="Hayır" <?php echo $service["POMPA"]=="Hayır" ? "checked" : ""; ?>>
						<label for="radio8">Hayır</label>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Kullanılan Pompa Tipi</label></div>
                    	<div class="col-xl-6">
						<select class="form-control" name="POMPATIPI" id="POMPATIPI">
							<option value="<?php echo $service["POMPATIPI"];?>"><?php echo $service["POMPATIPI"];?></option>
							<option value="Havalı (Diyafram)">Havalı (Diyafram)</option>
							<option value="Monopompa">Monopompa</option>
							<option value="Loplu Pompa">Loplu Pompa</option>
							<option value="Santrifüj Pompa">Santrifüj Pompa</option>
							<option value="Zeytinyağı Hamur Pompası">Zeytinyağı Hamur Pompası</option>
						</select>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Pompa Marka ve Model</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="POMPAMARKAMODEL" name="POMPAMARKAMODEL" value="<?php echo $service["POMPAMARKAMODEL"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Pompada Sürücü Var Mı?</label></div>
                    	<div class="col-xl-6 pt-2">
						<input type="radio" id="radio9" class="toggle" id="POMPADASURUCU" name="POMPADASURUCU" value="Evet" <?php echo $service["POMPADASURUCU"]=="Evet" ? "checked" : ""; ?>>
						<label for="radio9">Evet</label>
						
						<input type="radio" id="radio10"  class="toggle" id="POMPADASURUCU" name="POMPADASURUCU" value="Hayır" <?php echo $service["POMPADASURUCU"]=="Hayır" ? "checked" : ""; ?>>
						<label for="radio10">Hayır</label>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Pompa Maksimum Debisi <span class="badge badge-pill badge-warning">Üretici Etiket Bilgisi 50 Hz</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="POMPAMAKSIMUMDEBISI" name="POMPAMAKSIMUMDEBISI" value="<?php echo $service["POMPAMAKSIMUMDEBISI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Çalışma Frekansı <span class="badge badge-pill badge-warning">Hz</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="CALISMAFREKANSI" name="CALISMAFREKANSI" placeholder="Hz" value="<?php echo $service["CALISMAFREKANSI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Çalışma Yüzdesi <span class="badge badge-pill badge-warning">%</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="CALISMAYUZDESI" name="CALISMAYUZDESI" placeholder="%" value="<?php echo $service["CALISMAYUZDESI"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Debimetre Var mı?</label></div>
                    	<div class="col-xl-6 pt-2">
						<input type="radio" id="radio11" class="toggle" name="DEBIMETREVARMI" value="Evet" <?php echo $service["DEBIMETREVARMI"]=="Evet" ? "checked" : ""; ?>>
						<label for="radio11">Evet</label>
						
						<input type="radio" id="radio12" class="toggle" name="DEBIMETREVARMI" value="Hayır" <?php echo $service["DEBIMETREVARMI"]=="Hayır" ? "checked" : ""; ?>>
						<label for="radio12">Hayır</label>
                    	</div>
                    </div>
                    <!-- ÜRÜN POMPA BLOĞU DEBIMETRE VAR MI? debimetrevarmi -->
                    <div class="pompa-debimetre-alanlari hide">
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Dekantöre Beslenen Debi Miktarı <span class="badge badge-pill badge-warning">Debimetre</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control"  id="DEKBESDEBIMIK" name="DEKBESDEBIMIK" placeholder="" value="<?php echo $service["DEKBESDEBIMIK"];?>"></div>
	                    </div>
	                </div>
	                <!-- ÜRÜN POMPA BLOĞU DEBIMETRE VAR MI? -->


                </div>


                <div class="tab-pane" id="polymer-container" role="tabpanel" aria-labelledby="polymer-tab">

                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Sistemde Polimer Kullanılıyor mu?</label></div>
                    	<div class="col-xl-6 pt-2">
						<input type="radio" id="radio21" name="POLIMER" class="toggle" value="Evet" <?php echo $service["POLIMER"]=="Evet" ? "checked" : ""; ?>>
						<label for="radio21">Evet</label>
						
						<input type="radio" id="radio22" name="POLIMER" class="toggle" value="Hayır" <?php echo $service["POLIMER"]=="Hayır" ? "checked" : ""; ?>>
						<label for="radio22">Hayır</label>
                    	</div>
                    </div>
                    <!-- NUMUNE ALANLARI -->
                    <div class="polimer-alanlari hide">

	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Pompa HAUS tarafından mı verildi?</label></div>
	                    	<div class="col-xl-6 pt-2">
							<input type="radio" id="radio15" name="POLPOMPA" class="toggle" value="Evet" <?php echo $service["POLPOMPA"]=="Evet" ? "checked" : ""; ?>>
							<label for="radio15">Evet</label>
							
							<input type="radio" id="radio16" name="POLPOMPA" class="toggle" value="Hayır" <?php echo $service["POLPOMPA"]=="Hayır" ? "checked" : ""; ?>> 
							<label for="radio16">Hayır</label>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Kullanılan Pompa Tipi</label></div>
	                    	<div class="col-xl-6">
							<select class="form-control" name="POLPOMPATIPI" id="POLPOMPATIPI">
								<option value="<?php echo $service["POLPOMPATIPI"];?>"><?php echo $service["POLPOMPATIPI"];?></option>
								<option value="Havalı (Diyafram)">Havalı (Diyafram)</option>
								<option value="Monopompa">Monopompa</option>
								<option value="Loplu Pompa">Loplu Pompa</option>
								<option value="Santrifüj Pompa">Santrifüj Pompa</option>
								<option value="Zeytinyağı Hamur Pompası">Zeytinyağı Hamur Pompası</option>
							</select>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Pompa Marka ve Model</label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLPOMPAMARKAMODEL" name="POLPOMPAMARKAMODEL" value="<?php echo $service["POLPOMPAMARKAMODEL"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Pompada Sürücü Var Mı?</label></div>
	                    	<div class="col-xl-6 pt-2">
							<input type="radio" id="radio17" name="POLPOMPADASURUCU" class="toggle" value="Evet" <?php echo $service["POLPOMPADASURUCU"]=="Evet" ? "checked" : ""; ?>>
							<label for="radio17">Evet</label>
							
							<input type="radio" id="radio18" name="POLPOMPADASURUCU" class="toggle" value="Hayır" <?php echo $service["POLPOMPADASURUCU"]=="Hayır" ? "checked" : ""; ?>>
							<label for="radio18">Hayır</label>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Pompa Maksimum Debisi <span class="badge badge-pill badge-warning">Üretici Etiket Bilgisi 50 Hz</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLPOMPAMAXDEBI" name="POLPOMPAMAXDEBI" value="<?php echo $service["POLPOMPAMAXDEBI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Çalışma Frekansı <span class="badge badge-pill badge-warning">Hz</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLCALISMAFREKANSI" name="POLCALISMAFREKANSI" placeholder="Hz" value="<?php echo $service["POLCALISMAFREKANSI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Çalışma Yüzdesi <span class="badge badge-pill badge-warning">%</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLCALISMAYUZDESI" name="POLCALISMAYUZDESI" placeholder="%" value="<?php echo $service["POLCALISMAYUZDESI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Debimetre Var mı?</label></div>
	                    	<div class="col-xl-6 pt-2">
							<input type="radio" id="radio19" class="toggle" name="POLDEBIMETREVARMI" value="Evet" <?php echo $service["POLDEBIMETREVARMI"]=="Evet" ? "checked" : ""; ?>>
							<label for="radio19">Evet</label>
							
							<input type="radio" id="radio20" class="toggle" name="POLDEBIMETREVARMI" value="Hayır" <?php echo $service["POLDEBIMETREVARMI"]=="Hayır" ? "checked" : ""; ?>>
							<label for="radio20">Hayır</label>
	                    	</div>
	                    </div>
	                    <!-- POLIMER POMPA BLOĞU DEBIMETRE VAR MI? -->
	                    <div class="polimer-debimetre-alanlari hide">
		                    <div class="row">
		                    	<div class="col-xl-6"><label for="" class="input-label">Dekantöre Beslenen Debi Miktarı <span class="badge badge-pill badge-warning">Debimetre</span></label></div>
		                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLDEKBESDEBIMIK" name="POLDEKBESDEBIMIK" value="<?php echo $service["POLDEKBESDEBIMIK"];?>"></div>
		                    </div>
		                </div>
		                <!-- POLIMER POMPA BLOĞU POLIMER KULLANIMI -->
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Polimer Tank Kapasitesi</label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLTANKKAP" name="POLTANKKAP" value="<?php echo $service["POLTANKKAP"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Kullanılan Polimer Markası ve Kodu</label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control"  id="KULPOLMARKAKOD" name="KULPOLMARKAKOD" value="<?php echo $service["KULPOLMARKAKOD"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Polimer Hazırlama Oranı <span class="badge badge-pill badge-warning">%</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLHAZIRORANI" name="POLHAZIRORANI" value="<?php echo $service["POLHAZIRORANI"];?>"></div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-xl-6"><label for="" class="input-label">Polielektrolit Sarfiyatı <span class="badge badge-pill badge-warning">Ton KM Başına</span></label></div>
	                    	<div class="col-xl-6"><input type="text" class="form-control" id="POLSARF" name="POLSARF" value="<?php echo $service["POLSARF"];?>"></div>
	                    </div>

	                </div>





                </div>



                <div class="tab-pane" id="energy-container" role="tabpanel" aria-labelledby="energy-tab">

                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Tambur Motoru</label></div>
                    	<div class="col-xl-6 input-group">
                    		<input type="number" class="form-control" id="TAMBURMOTORUHZ" name="TAMBURMOTORUHZ" placeholder="Hz" value="<?php echo $service["TAMBURMOTORUHZ"];?>">
                    		<input type="number" class="form-control" id="TAMBURMOTORUKW" name="TAMBURMOTORUKW" placeholder="kW" value="<?php echo $service["TAMBURMOTORUKW"];?>">
                    		<input type="number" class="form-control" id="TAMBURMOTORUAMPER" name="TAMBURMOTORUAMPER" placeholder="Amper" value="<?php echo $service["TAMBURMOTORUAMPER"];?>">
                    	</div>
                    </div>
                    <div class="row">
	                    <div class="col-xl-6"><label for="" class="input-label">Helezon Motoru</label></div>
	                    <div class="col-xl-6 input-group">
	                        <input type="number" class="form-control"  id="HELEZONMOTORUHZ"   name="HELEZONMOTORUHZ" placeholder="Hz" value="<?php echo $service["HELEZONMOTORUHZ"];?>">
	                        <input type="number" class="form-control"  id="HELEZONMOTORUKW"    name="HELEZONMOTORUKW" placeholder="kW" value="<?php echo $service["HELEZONMOTORUKW"];?>">
	                        <input type="number" class="form-control"  id="HELEZONMOTORUAMPER" name="HELEZONMOTORUAMPER" placeholder="Amper" value="<?php echo $service["HELEZONMOTORUAMPER"];?>">
	                    </div>
                    </div>
                </div>




                <div class="tab-pane" id="perfomance-container" role="tabpanel" aria-labelledby="perfomance-tab">

                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Dekantör Kek Çıkışı KM</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="DEKKEKCIKIS" name="DEKKEKCIKIS" placeholder="%" value="<?php echo $service["DEKKEKCIKIS"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Dekantör Kek Çıkışı KM <span class="badge badge-pill badge-warning">Müşteri Beklentisi Opsiyonel</span></label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="MUSDEKKEKCIKIS" name="MUSDEKKEKCIKIS" placeholder="%" value="<?php echo $service["MUSDEKKEKCIKIS"];?>"></div>
                    </div>
                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Dekantör Sentrat Çıkışı KM</label></div>
                    	<div class="col-xl-6"><input type="text" class="form-control" id="DEKSENTRATCIKIS" name="DEKSENTRATCIKIS" placeholder="%" value="<?php echo $service["DEKSENTRATCIKIS"];?>"></div>
                    </div>


                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Sentrat Hacim Oranları</label></div>
                    	<div class="col-xl-6 input-group">
                    		<input type="number" class="form-control" id="SENTRATHACYAG" name="SENTRATHACYAG" placeholder="Yağ Oranı %" value="<?php echo $service["SENTRATHACYAG"];?>">
                    		<input type="number" class="form-control" id="SENTRATHACSU" name="SENTRATHACSU" placeholder="Su Oranı %" value="<?php echo $service["SENTRATHACSU"];?>">
                    		<input type="number" class="form-control" id="SENTRATHACTORTU" name="SENTRATHACTORTU" placeholder="Tortu Oranı %" value="<?php echo $service["SENTRATHACTORTU"];?>">
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-xl-6"><label for="" class="input-label">Dekantör Yağ Çıkışı</label></div>
                        <div class="col-xl-6 input-group">
                            <input type="number" class="form-control" id="DEKANTORYAG" name="DEKANTORYAG" placeholder="Yağ Oranı %" value="<?php echo $service["DEKANTORYAG"];?>">
                            <input type="number" class="form-control" id="DEKANTORSU"   name="DEKANTORSU" placeholder="Su Oranı %" value="<?php echo $service["DEKANTORSU"];?>">
                            <input type="number" class="form-control" id="DEKANTORTORTU" name="DEKANTORTORTU" placeholder="Tortu Oranı %" value="<?php echo $service["DEKANTORTORTU"];?>">
                        </div>
                    </div>
                </div>









                <div class="tab-pane" id="finish-container" role="tabpanel" aria-labelledby="finish-tab">

                	<br />
					
					<br />
                   <div class="upload-container">
                        <i class="fa fa-file-text-o" style="font-size: 18px;"></i> Belge Yüklemek Için Sürükleyin
                    </div>
                    <br />
                    <input id="fileupload" type="file" name="files[]" multiple style="display: none;">
                    <label class="btn btn-primary" for="fileupload"><i class="fa fa-upload"></i> Belge Seç ve Yükle</label>
                    <br /><br /><br /><br />
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success">
                            
                        </div>
                    </div>
				    <div id="files" class="files"></div>
				    <br /><br />

                     <div class="row">
                        <div class="col-xl-6"><label for="" class="input-label">Sözleşme Şartları Sağlandı mı?</label></div>
                        <div class="col-xl-6 pt-2">
                        <input type="radio" id="radio13" name="SOZLESME" class="toggle" value="1" <?php echo $service["SOZLESME"]=="1" ? "checked" : ""; ?>>
                        <label for="radio13">Evet</label>
                        
                        <input type="radio" id="radio14" name="SOZLESME" class="toggle" value="2" <?php echo $service["SOZLESME"]=="2" ? "checked" : ""; ?>>
                        <label for="radio14">Hayır</label>
                        </div>
                    </div>


                    <div class="row">
                    	<div class="col-xl-12"><label for="" class="input-label">Açıklamalar <span class="badge badge-pill badge-warning">Opsiyonel</span></label></div>
                    	<div class="col-xl-12"><input type="text" class="form-control" id="ACIKLAMALAR" name="ACIKLAMALAR" value="<?php echo $service["ACIKLAMALAR"];?>"></div>
                    </div>


				    <br /><br /><br /><br />


					

                    <?php
                    $onay__sql_ = oci_parse($ORACLEconnection, "SELECT HAKDEVREYEALMADURUM FROM  HAKBREAKDOWNSFORM WHERE BREAKDOWNNUM='".strip_tags($_POST["breakdownnum"])."'");
				    oci_execute($onay__sql_);
				    $formonay = oci_fetch_array($onay__sql_, OCI_ASSOC+OCI_RETURN_LOB);

                    if ($formonay["HAKDEVREYEALMADURUM"]==0) 
                    {
                    	echo '<input class="btn btn-primary mr-2" type="submit"  value="';
                    	echo $_POST["id"]=="" ? "Yeni Formu Oluştur & Kaydet" : "Düzenlemeleri Kaydet";
                    	echo '">';

                    	if(oci_num_rows($sql)>0)
						{
	                    	if(AUTHORITY=="Lab")
		                    {
		                    	echo '<a href="#" class="btn btn-primary mr-2 delete">Formu Sil</a>'; 
		                        echo '<a href="#" class="btn btn-primary mr-2 approve">Devreye Alma Formu Olarak İşaretle</a>';          
		                    }
						}
                    }

       
                    

                    ?>


                  

                </div>
            </div>
        </div>


    </form>



    </div>
</div>

<?php

 

}


?>


<script>
$(document).ready(function() {

    $(function () {
        'use strict';
        $('#fileupload').fileupload({
            url: "include/upload/index.php",
            dataType: 'json',
            formData: {breakdownnum: "<?php echo $_POST["breakdownnum"];?>", field: "FORM"},
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css('width', progress + '%');
            }
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
    });

<?php
echo $service["MOTOR"]=="1" ? '$(".single-motor-alanlari").show("fast");' : '$(".single-motor-alanlari").hide("fast");';
echo $service["NUMUNE"]=="Hayır" ? '$(".numune-alanlari").show("fast");' : '$(".numune-alanlari").hide("fast");';
echo $service["DEBIMETREVARMI"]=="Evet" ? '$(".pompa-debimetre-alanlari").show("fast");' : '$(".pompa-debimetre-alanlari").hide("fast");';
echo $service["POLIMER"]=="Evet" ? '$(".polimer-alanlari").show("fast");' : '$(".polimer-alanlari").hide("fast");';
echo $service["DEBIMETREVARMI"]=="Evet" ? '$(".polimer-debimetre-alanlari").show("fast");' : '$(".polimer-debimetre-alanlari").hide("fast");';

if($service["MOTOR"]=="1")
        {
            echo '$(".single-motor-alanlari").show("fast");';
            echo '$(".dual-motor-alanlari").hide("fast");';
        }
elseif($service["MOTOR"]=="2")
{
    echo '$(".single-motor-alanlari").hide("fast");';
    echo '$(".dual-motor-alanlari").show("fast");';
}

?>
       


$(document).on("click", ".toggle", function()
{
	var field = $(this).attr("name");
	var value = $(this).val();
	
	if(field=="MOTOR" && value=="1")
	{
		$(".dual-motor-alanlari").hide("fast");
		$(".single-motor-alanlari").show("fast");
	}
	else if(field=="MOTOR" && value=="2")
	{
		$(".dual-motor-alanlari").show("fast");
		$(".single-motor-alanlari").hide("fast");
	}
	//
	/*if(field=="FAZ" && value=="2")
	{
		$(".bek-ayari-alanlari").hide("fast");
	}
	else if(field=="FAZ" && value=="3")
	{
		$(".bek-ayari-alanlari").show("fast");
	}*/
	//
	if(field=="NUMUNE" && value=="Evet")
	{
		$(".numune-alanlari").hide("fast");
	}
	else if(field=="NUMUNE" && value=="Hayır")
	{
		$(".numune-alanlari").show("fast");
	}
	//
	if(field=="DEBIMETREVARMI" && value=="Evet")
	{
		$(".pompa-debimetre-alanlari").show("fast");
	}
	else if(field=="DEBIMETREVARMI" && value=="Hayır")
	{
		$(".pompa-debimetre-alanlari").hide("fast");
	}
	//
	if(field=="POLIMER" && value=="Evet")
	{
		$(".polimer-alanlari").show("fast");
	}
	else if(field=="POLIMER" && value=="Hayır")
	{
		$(".polimer-alanlari").hide("fast");
	}
	//

    //
    if(field=="POLPOMPADASURUCU" && value=="Evet")
    {
        $(".polpompadasurucu-alanlari").show("fast");
    }
    else if(field=="POLPOMPADASURUCU" && value=="Hayır")
    {
        $(".polpompadasurucu").hide("fast");
    }
    //

	if(field=="POLDEBIMETREVARMI" && value=="Evet")
	{
		$(".polimer-debimetre-alanlari").show("fast");
	}
	else if(field=="POLDEBIMETREVARMI" && value=="Hayır")
	{
		$(".polimer-debimetre-alanlari").hide("fast");
	}
	//




});


	$(document).on("click", ".approve", function()
	{
	    $.ajax({
	        type:"POST",
	        url:"include/process.php?action=approve",
	        dataType:"text",
	        data:$("form#edit").serialize(),
	    })
	    .done(function(response) {
	        response = response.trim();
	        if(response=="true")
	        {
	            swal({title: "Onay Başarılı!", text: "Form onaylandı.", icon: "success"}).then(function() {
	                window.location.href = "index.php";
	        		alert("response");
	            });

	        }
	        else
	        {
	            swal({title: "Hata!", text: "Onay verilirken bir hata oluştu", icon: "error"});
	            alert("abc");
	        }
	        
	    });
	});


    $("form#new").submit(function(e) {
    	var isValid = true;
    	//
    	$(".required").each(function() {
    		var element = $(this);
    		if (element.val() == "") {
    			isValid = false;
    		}
    	});
    	//
    	if(isValid==true || 1==1)
    	{
            var formData = new FormData(this);
            $.ajax({
                type:"POST",
                url:"include/process.php?action=save", 
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(response) {
            	alert(response);
                if(response=="true"){
    				swal({title: "Işlem Başarılı!", text: "Tüm bilgiler kaydedildi!", icon: "success",}).then(function() {

    				});
                }
            });


    	}
    	else
    	{
    		swal({title: "Hata!", text: "Lütfen zorunlu alanları doldurunuz!", icon: "error"});
    	}
        event.preventDefault();
    });


    $("form#edit").submit(function(e) {

        var formData = new FormData(this);
        $.ajax({
            url:"include/process.php?action=update",
            type: "POST",
            data: formData ,
            success: function (response) {
                response = response.trim();
                if(response=="true")
                {
                    swal("İşlem Başarılı", "Laboratuvar formu düzenlendi!", "success");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        event.preventDefault();
    });








   




});






</script>