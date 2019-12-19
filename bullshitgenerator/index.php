<?php
// 废话生成器

$data = json_decode(file_get_contents('data.json'), true);
$title = !empty($_GET['title']) ? $_GET['title'] : $data['title'];
$content = '';

for ($j = 0; $j < 5; $j++) {
    $content .= getSection($data) . "<br><br>";
}
echo "<br><br><h2 style='text-align: center'>$title</h2><br><br>";
echo($content);

function getSection($data)
{
    $title = !empty($_GET['title']) ? $_GET['title'] : $data['title'];
    $before_arr = $data['before'];
    $after_arr = $data['after'];
    $bosh_arr = $data['bosh'];
    $famous_arr = $data['famous'];
    $section = '';

    for ($j = 0; $j < 5; $j++) {
        $before = $before_arr[array_rand($before_arr)];
        $after = $after_arr[array_rand($after_arr)];

        $famous = $famous_arr[array_rand($famous_arr)];
        $famous = str_replace("a", $before, $famous);
        $famous = str_replace("b", $after, $famous);

        $bosh_str = '';
        for ($i = 0; $i < 3; $i++) {
            $bosh = $bosh_arr[array_rand($bosh_arr)];
            $bosh = str_replace("x", $title, $bosh);
            $bosh_str .= $bosh;
        }

        $section .= $bosh_str . $famous;
    }
    return $section;
}
