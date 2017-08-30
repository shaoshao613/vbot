<?php

namespace Hanson\Vbot\Console;

use PHPQRCode\QRcode as QrCodeConsole;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class QrCode extends Console
{
    /**
     * show qrCode on console.
     *
     * @param $text
     *
     * @return bool
     */
    public function show($text)
    {
        if (!array_get($this->config, 'qrcode', true)) {
            return false;
        }







        $output = new ConsoleOutput();



        static::initQrcodeStyle($output);





        $text = QrCodeConsole::text($text);

	    $pxMap[0] = Console::isWin() ? "\e[1;37mmm\e[1;37m\e[0m" : "\e[47;30m  \e[0m";
	    $pxMap[1] = "\033[40;37m  \e[0m";

	    $length = strlen($text[0]);
	    printf("\n");
	    foreach ($text as $line) {
		    printf($pxMap[0]);
		    for ($i = 0; $i < $length; $i++) {
			    $type = substr($line, $i, 1);
			    printf($pxMap[$type]);
		    }
		    printf($pxMap[0]."\n");
	    }

//	    $pxMap[0] = Console::isWin() ? '<whitec>mm</whitec>' : '<whitec>mm</whitec>';
//	    $pxMap[1] = '<blackc>  </blackc>';
//
//        $length = strlen($text[0]);
//        $output->write("\n");
//        foreach ($text as $line) {
//            $output->write($pxMap[0]);
//            for ($i = 0; $i < $length; $i++) {
//                $type = substr($line, $i, 1);
//                $output->write($pxMap[$type]);
//            }
//            $output->writeln($pxMap[0]);
//        }
//


    }

    /**
     * init qrCode style.
     *
     * @param OutputInterface $output
     */
    private static function initQrcodeStyle(OutputInterface $output)
    {
        $style = new OutputFormatterStyle('black', 'black', ['bold']);
        $output->getFormatter()->setStyle('blackc', $style);
        $style = new OutputFormatterStyle('white', 'white', ['bold']);
        $output->getFormatter()->setStyle('whitec', $style);
    }
}
