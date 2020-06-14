<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <h3 class="title">ערכים תזונתיים</h3>


    <div id="mainWrraper">
        <div id="searchWrraper">

            <form action="" method="get">
                <fieldset class="center">
                    <div class="inputWrapper"><label for="query"><b>הזן/י את שם הפריט:</b></label>
                        <input id="query" type="text" name="query" /> </div>
                    <div class="inputWrapper"><input class="submitBtn" name="submit" type="submit" value="הצג ערכים תזונתיים" ></div>
                </fieldset>
                <!--                <a class="inputWrapper center" id="btnTranslate" href="#"> לתרגום שם הפריט שברצונך לחפש לאנגלית לחץ/י כאן</a>
                                <div id="translate">  
                                    <div> 
                                        <center><object type="text/html" data="https://www.morfix.co.il/" width="600px" height="150px">
                                            </object></center>
                                    </div>
                                </div>-->
            </form>
        </div>




        <?php
        $name = filter_input(INPUT_GET, 'query');
        for ($i = 0; $i < strlen($name); $i++) {
            if ($name[$i] == " ") {
                $name[$i] = '-';
            }
        }
        if (filter_input(INPUT_GET, 'query') != null && filter_input(INPUT_GET, 'query') != '') {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/parser?ingr=" . $name,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: edamam-food-and-grocery-database.p.rapidapi.com",
                    "x-rapidapi-key: 4bf6a33b5fmsh4403b5a9cc0cc54p13b00ejsn45a57fd91e7a"
                ),
            ));

            $response = json_decode(curl_exec($curl), true);
            $err = curl_error($curl);

            curl_close($curl);
        }

        if (!empty($response["hints"])) {
            echo '<center><b>הנתונים שנמצאו:</b></center><br>';
            for ($i = 0; $i < 4; $i++) {
                if (isset($response["hints"][$i])) {
                    echo '<div class="itemValuesArea">';
                    echo '<h4 class="itemValuesTitle">' . $response["hints"][$i]['food']['label'] . '</h4><br>';
                    if (isset($response["hints"][$i]['food']['nutrients']['ENERC_KCAL'])) {
                        $energy = number_format((float) $response["hints"][$i]['food']['nutrients']['ENERC_KCAL'], 2, '.', '');
                        echo '<b>אנרגיה: </b>' . $energy . ' קלוריות<br>';
                    }
                    if (isset($response["hints"][$i]['food']['nutrients']['FAT'])) {
                        $fat = number_format((float) $response["hints"][$i]['food']['nutrients']['FAT'], 2, '.', '');
                        echo '<b>שומן: </b>' . $fat . ' גרם<br>';
                    }
                    if (isset($response["hints"][$i]['food']['nutrients']['PROCNT'])) {
                        $procnt = number_format((float) $response["hints"][$i]['food']['nutrients']['PROCNT'], 2, '.', '');
                        echo '<b>חלבון: </b>' . $procnt . ' גרם<br>';
                    }
                    if (isset($response["hints"][$i]['food']['nutrients']['FIBTG'])) {
                        $fibtg = number_format((float) $response["hints"][$i]['food']['nutrients']['FIBTG'], 2, '.', '');
                        echo '<b>סיבים: </b>' . $fibtg . ' גרם<br>';
                    }
                    if (isset($response["hints"][$i]['food']['nutrients']['CHOCDF'])) {
                        $chocdf = number_format((float) $response["hints"][$i]['food']['nutrients']['CHOCDF'], 2, '.', '');
                        echo '<b>כולסטרול: </b>' . $chocdf . ' מ"ג<br><br>';
                    }
                    if (isset($response["hints"][$i]['food']['image'])) {
                        echo '<img class="itemValiesImg" src="data:image/jpeg;base64,' . base64_encode(file_get_contents($response["hints"][$i]['food']['image'])) . '"/>';
                    }
                    echo '</div><hr>';
                }
            }
        } else if ($_GET) {
            echo '<p id="error">לא קיימים נתונים במאגר <br> שים לב כי הזנת נתון באנגלית </p>';
        }
        ?>


    </div>
</main>

<script>
    $(document).ready(function () {
        $("#btnTranslate").click(function () {
            $("#translate").toggle();
        });
    });
</script>