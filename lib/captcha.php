<?php


class Captcha
{
    public function generateCaptcha()
    {
        $letters = array_merge(range('A', 'Z'), range(0, 9), range('a', 'z'));
        for ($i = 0; $i < 5; $i++) {
            unset($letters[rand(0, count($letters) - 1)]);
        }
        shuffle($letters);
        $selected_letters = array_slice($letters, 0, 4);
        $secure_text = implode('', $selected_letters);
        

        $_SESSION['captcha'] = $secure_text;
    }
    

    public function showCaptcha()
    {
        $letters = str_split($_SESSION['captcha']);
        

        $im = imagecreatetruecolor(150, 70);

        
        $bg = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $bg);

        $i = 0;

        // render a cada letra/numero com uma cor diferente/posição diferente
        foreach ($letters as $letter) {
            $text_color = imagecolorallocate($im, rand(0, 100), rand(10, 100), rand(0, 100));
            imagefttext($im, 35, rand(-10, 10), 20+($i*30) + rand(-5, +5), 35 + rand(10, 30), $text_color, 'css/fonts/HelveticaNeue-Bold.woff', $letter);
            $i++;
        }

        header('Content-type: image/png');
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, proxy-revalidate');
       

        imagepng($im);
        imagedestroy($im);
    }
    

    public function checkCaptcha()
    {
        if ($_POST["captcha"] == $_SESSION['captcha']) {
            return true;
        } else {
            return false;
        }
    }
}
