<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project UAS Semantik Web</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Psikologi.css">
</head>

<body>
<?php
        require_once("sparqllib.php");
        $searchInput = "" ;
        $filter = "" ;
        
        if (isset($_POST['search'])) {
            $searchInput = $_POST['search'];
            $data = sparql_get(
            "https://ec24-36-74-45-141.ap.ngrok.io/dataSiswa/",
            "
            prefix id: <https://portalpsikologi.com/>
            prefix person: <https://portalpsikologi.com/ns/person#>
            prefix rdf: <http://www.w3.org/1999/02/22-rid:Af-syntax-ns#>
            SELECT ?nisn ?namaSekolah ?namaSiswa ?jk ?ttl ?rtsSatu ?rtsDua ?rtsTiga ?rtsEmpat ?rtsLima ?jumlahRtn ?keterangan
            WHERE
            { 
                ?persons
                    person:nisn           ?nisn ;
                    person:namaSekolah    ?namaSekolah;
                    person:namaSiswa      ?namaSiswa ;
                    person:jk             ?jk ;
                    person:ttl            ?ttl ;
                    person:rtsSatu        ?rtsSatu ;
                    person:rtsDua         ?rtsDua ;
                    person:rtsTiga        ?rtsTiga ;
                    person:rtsEmpat       ?rtsEmpat ;
                    person:rtsLima        ?rtsLima ;
                    person:jumlahRtn      ?jumlahRtn ;
                    person:keterangan     ?keterangan .
                    FILTER (regex (?nisn, '${searchInput}', 'i') || regex (?namaSekolah, '${searchInput}', 'i') || regex (?namaSiswa, '${searchInput}', 'i') || regex (?jk, '${searchInput}', 'i') || regex (?ttl, '${searchInput}', 'i') || regex (?rtsSatu, '${searchInput}', 'i') || regex (?rtsDua, '${searchInput}', 'i') || regex (?rtsTiga, '${searchInput}', 'i') || regex (?rtsEmpat, '${searchInput}', 'i') || regex (?rtsLima, '${searchInput}', 'i') || regex (?jumlahRtn, '${searchInput}', 'i') || regex (?keterangan, '${searchInput}', 'i'))
            }"
            );
        } else {
            $data = sparql_get(
            "https://ec24-36-74-45-141.ap.ngrok.io/dataSiswa/",
            "
            prefix id: <https://portalpsikologi.com/>
            prefix person: <https://portalpsikologi.com/ns/person#>
            prefix rdf: <http://www.w3.org/1999/02/22-rid:Af-syntax-ns#>
                
            SELECT ?nisn ?namaSekolah ?namaSiswa ?jk ?ttl ?rtsSatu ?rtsDua ?rtsTiga ?rtsEmpat ?rtsLima ?jumlahRtn ?keterangan
            WHERE
            { 
                ?persons
                    person:nisn         ?nisn ;
                    person:namaSekolah  ?namaSekolah;
                    person:namaSiswa    ?namaSiswa ;
                    person:jk           ?jk ;
                    person:ttl          ?ttl ;
                    person:rtsSatu      ?rtsSatu ;
                    person:rtsDua       ?rtsDua ;
                    person:rtsTiga      ?rtsTiga ;
                    person:rtsEmpat     ?rtsEmpat ;
                    person:rtsLima      ?rtsLima ;
                    person:jumlahRtn    ?jumlahRtn ;
                    person:keterangan   ?keterangan .
            }"
            );
        }

        if (!isset($data)) {
            print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
        }
    ?>

    <div class="navbar">
        <div class="container">
            <div class="col-md-6">
                <h2 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size: 43px; color: #f0ecef;">Selamat Datang !</h2>
                <h5 style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size: 23px; color: #f0ecef;">Calon Mahasiswa Psikologi Unpad 2022</h5>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
               <div class="col-md-6">
                <img src="images/fapsi.png" style="width: 900px; height: 300px; margin-left: 190px; margin-top: 30px;border-radius: 40px; box-shadow: 6px 10px 5px rgba(0, 0, 0, 0.25);">
            </div>
            <div class="text col-md-6">
                <p>Selamat Datang, Calon Mahasiswa Psikologi Unpad 2022 !<br>Website ini berfungsi untuk melihat rata - rata nilai rapot seluruh siswa yang ada di Kuningan, Jawa Barat yang ingin mendaftar SNMPTN 2022<br>di Jurusan Psikologi Unpad agar nantinya dapat memprediksi untuk kelulusan kalian pada SNMPTN 2022 di jurusan tersebut.</p>
            </div> 
        </center>
        <br>
        <br>
        <div class="box" align="left" style="position:relative;">
            <div class="content">
            <form class="d-flex" role="search" action="" method="post" id="search" name="search">
                    <input class="form-control me-2" type="search" placeholder=" &nbsp &nbsp Masukkan Informasi Siswa" aria-label="Search" name="search" style="box-shadow: 5px 4px 3px rgba(0, 0, 0, 0.25);width: 1000px; height:60px;border-radius:20px;margin-top:100px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight:600;font-size: 16px;background-color: #63246a; color: #f0ecef; padding-left: 60px; padding-top: 13px;">
                    <button class="btn btn-outline-success" type="submit" style="box-shadow: 5px 4px 3px rgba(0, 0, 0, 0.25);width: 350px; height:60px;border-radius:30px;margin-top:40px;margin-left:450px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight:600;border-radius:20px;font-size: 16px;background-color: #63246a; color: #f0ecef;margin-top:100px;margin-left:140px">Cari</button>
                </form><br><br>
                </div>
        </center>
            
            <div class="teks col-md-6">
                <p>Hasil Pencarian</p>
            </div> 
            </div> 
        </div>
    </div>

    <div class="result">
        <div class="container">
        <?php
                if ($searchInput != NULL) {
                    ?> 
                        <h3 style="margin-top: 59px;margin-bottom: -50px;color:#90448c;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight:600;font-size: 30px;">Hasil Pencarian <span>"<?php echo $searchInput; ?>"</span></h3>
                    <?php
                } else {
                    ?> 
                        <h3 style="margin-top: 59px;margin-bottom: -50px;color:#90448c;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight:600;font-size: 30px;">Hasil Kriteria Nilai Siswa</h3> 
                    <?php
                }
            ?>
            <table class="resulttbl">
                <tr class="judul">
                    <th rowspan="2" style="border: 2px solid black">NISN</th>
                    <th rowspan="2" style="border: 2px solid black">Nama Sekolah</th>
                    <th rowspan="2" style="border: 2px solid black">Nama Siswa</th>
                    <th rowspan="2" style="border: 2px solid black">Jenis Kelamin</th>
                    <th rowspan="2" style="border: 2px solid black">Tempat, Tanggal Lahir</th>
                    <th colspan="5" style="border: 2px solid black">Rata - Rata Nilai Semester</th>
                    <th rowspan="2" style="border: 2px solid black">Jumlah Rata - Rata Nilai</th>
                    <th rowspan="2" style="border: 2px solid black">Keterangan</th>
                </tr>
                <tr class="judul">
                    <th style="border: 2px solid black">1</th>
                    <th style="border: 2px solid black">2</th>
                    <th style="border: 2px solid black">3</th>
                    <th style="border: 2px solid black">4</th>
                    <th style="border: 2px solid black">5</th>
                </tr>
                <?php $i = 0; ?>
                <?php foreach ($data as $data) : ?>
                <tr>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['nisn'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['namaSekolah'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['namaSiswa'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['jk'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['ttl'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['rtsSatu'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['rtsDua'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['rtsTiga'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['rtsEmpat'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['rtsLima'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['jumlahRtn'] ?></td>
                    <td style="border: 2px solid black; background-color:#f0ecef;"><?= $data['keterangan'] ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <h6 style="text-align: center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size: 12px; color: black;">© Copyright 2022 - Teknik Informatika Unpad [ Semantik Web ]</h6>
            <h6 style="text-align: center;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size: 12px; color: black;">Nadine Annisa Heartman - 140810190004</h6>
        </div>
    </div>

</body>

</html>