<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Check Resi</title>
</head>

<body>
    <div class="container mt-5 pt-5">
        <p class="fw-bold">CEK RESI</p>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control" name="check_resi" id="check_resi" placeholder="input resi anda" value="18022470553">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-lg btn-primary" id="check">Cek</button>
            </div>
        </div>

        <div class="mt-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="jne">
                <label class="form-check-label" for="inlineRadio1">JNE</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="jnt">
                <label class="form-check-label" for="inlineRadio2">JNT</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">TIKI</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="pos">
                <label class="form-check-label" for="inlineRadio2">POS</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="sicepat">
                <label class="form-check-label" for="inlineRadio2">Sicepat</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="anteraja">
                <label class="form-check-label" for="inlineRadio2">AnterAja</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="ninja">
                <label class="form-check-label" for="inlineRadio2">Ninja</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="jnt">
                <label class="form-check-label" for="inlineRadio2">JNT</label>
            </div>
        </div>
        <div class="mt-3 pt-3" id="status"></div>
        <table class="mt-3 table col-lg-8 table-bordered table-stripped ">
            <thead>
                <tr>
                    <th>Nomor Resi</th>
                    <th>Tanggal Pengirim</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                </tr>
            </thead>
            <tbody id="resi-data">
            </tbody>
        </table>

        <div class="row mb-3">
            <div class="col-lg-8">
                <p class="mt-3">Detail Pengirim</p>
            </div>
            <div class="col-lg-4">
                <p class="mt-3">Respon Toko</p>
                <p></p>
                <div id="status_response"></div>
            </div>
        </div>

        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>
                        Tanggal Waktu
                    </th>
                    <th>Desc</th>
                </tr>
            </thead>
            <tbody id="resi-desc">
            </tbody>
        </table>
    </div>
</body>
<script>
    $(document).ready(function() {

        $('#check').click(function() {
            var get_resi = $("#check_resi").val();
            // var get_servie = $('input[name="inlineRadioOptions"]:checked').val();
            // if (get_resi && get_servie) {
            // }
            getApiResi(get_resi);
        })

        function getApiResi(resi) {
            const uri = 'https://api.binderbyte.com/v1/track?api_key=cdec08e082560fd3e0c574665218562652434e9212792eac5e78cf5551f8136f&courier=pos&awb=18022470553'
            $.ajax({
                url: uri,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {

                    const result = data.data
                    for (var i = 0; i < result.history.length; i++) {
                        var date_data = result.history[i].date
                        var dateTime = moment(date_data).format('DD MMMM, YYYY HH:mm:ss')
                        var html = '<tr>\
                                       <td>' + dateTime + '</td> \
                                       <td>' + result.history[i].desc + '</td> \
                                        </tr>'
                        $('#resi-desc').append(html)
                    }

                    var dateTime1 = moment(result.history[0].date).format('DD MMMM, YYYY HH:mm:ss');

                    var html_sumary = '<tr>\
                                       <td>' + result.summary.awb + '</td> \
                                       <td>' + result.summary.date + '</td> \
                                       <td>' + result.detail.shipper + '</td> \
                                       <td>' + result.detail.receiver + '</td>\
                                        </tr>\
                                        <tr>\
                                       <td> Courir terpilih</td> \
                                       <td>' + result.summary.date + '</td> \
                                       <td>' + result.detail.origin + '</td> \
                                       <td>' + result.detail.receiver + '</td>\
                                        </tr>'
                    var status_resi = '<p class="fw-bold">' + result.summary.status + ' TO ' + result.detail.receiver + ', ' + result.detail.origin + ',' + dateTime1 + '<p>'
                    var html = '<span class="badge bg-success">Sangat Baik</span>'

                    $('#status_response').html(html)
                    $('#resi-data').append(html_sumary)
                    $('#status').html(status_resi)
                }
            })
        }
    })
</script>

</html>