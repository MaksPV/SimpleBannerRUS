<?php
/*
8888888                            888888888  888888888  
  888                              888        888        
  888                              888        888        
  888   88888b.  888  888 888  888 8888888b.  8888888b.  
  888   888 "88b 888  888 888  888      "Y88b      "Y88b 
  888   888  888 Y88  88P 888  888        888        888 
  888   888  888  Y8bd8P  Y88b 888 Y88b  d88P Y88b  d88P 
8888888 888  888   Y88P    "Y88888  "Y8888P"   "Y8888P"  
                               888                       
                          Y8b d88P                       
                           "Y88P"
			
Translated by
 _____ ______   ________  ___  __    ________  ________  ___      ___ 
|\   _ \  _   \|\   __  \|\  \|\  \ |\   ____\|\   __  \|\  \    /  /|
\ \  \\\__\ \  \ \  \|\  \ \  \/  /|\ \  \___|\ \  \|\  \ \  \  /  / /
 \ \  \\|__| \  \ \   __  \ \   ___  \ \_____  \ \   ____\ \  \/  / / 
  \ \  \    \ \  \ \  \ \  \ \  \\ \  \|____|\  \ \  \___|\ \    / /  
   \ \__\    \ \__\ \__\ \__\ \__\\ \__\____\_\  \ \__\    \ \__/ /   
    \|__|     \|__|\|__|\|__|\|__| \|__|\_________\|__|     \|__|/    
                                       \|_________|                   
                                                                      
                                                                      
----- This project is under the GNU Affero General Public License v3.0 -----                       
*/
declare(strict_types=1);
namespace MaksPV\SimpleBannerRUS;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use jojoe77777\FormAPI\SimpleForm; //Form api
use pocketmine\nbt\JsonNbtParser;
class Main extends PluginBase implements Listener{
    public function onEnable() {
        $this->colortags = ['BLACK'=>'0', 'DARK_GREEN'=>'2', 'DARK_AQUA'=>'3', 'DARK_PURPLE'=>'5', 'ORANGE'=>'6', 'GRAY'=>'7', 'DARK_GRAY'=>'8', 'BLUE'=>'9', 'GREEN'=>'a', 'AQUA'=>'b', 'RED'=>'c', 'LIGHT_PURPLE'=>'d', 'YELLOW'=>'e', 'WHITE'=>'f'];
        $this->colors = ['BLACK', 'DARK_GREEN', 'DARK_AQUA', 'DARK_PURPLE', 'ORANGE', 'GRAY', 'DARK_GRAY', 'BLUE', 'GREEN', 'AQUA', 'RED', 'LIGHT_PURPLE', 'YELLOW', 'WHITE'];
        $this->bannerc = ['BLACK'=>'0',  'DARK_GREEN'=>'2', 'DARK_AQUA'=>'6', 'DARK_PURPLE'=>'5', 'ORANGE'=>'14', 'GRAY'=>'7', 'DARK_GRAY'=>'8', 'BLUE'=>'4', 'GREEN'=>'10', 'AQUA'=>'12', 'RED'=>'1', 'LIGHT_PURPLE'=>'9', 'YELLOW'=>'11', 'WHITE'=>'15'];
        $this->items = ['Градиент сверху вниз', 'Градиент снизу вверх', 'Кирпичи', 'Верхняя половина прямоугольника', 'Нижняя половина прямоугольника', 'Левая половина прямоугольника', 'Правая половинка прямоугольника', 'Верхний маленький прямоугольник', 'Нижний маленький прямоугольник', 'Левый маленький прямоугольник', 'Правый маленький прямоугольник', 'Верхний левый треугольник', 'Верхний правый треугольник', 'Нижний левый треугольник', 'Нижний правый треугольник', 'Большой §lX', 'Диагональ §l/', 'Диагональ §l\\', 'Крест §l+', 'Центрированная вертикальная линия', 'Центрированная горизонтальная линия', 'Верхний левый квадрат', 'Верхний правый квадрат', 'Нижний левый квадрат', 'Нижний правый квадрат', 'Верхний треугольник', 'Нижний треугольник', 'Центрированный ромб', 'Центрированный "круг"', 'Нижние шипы', 'Верхние шипы', '4 горизонтальных линий', 'Рамка', 'Шипастая рамка', 'Центрированный цветок', 'Голова криппера', 'Центральный череп', 'Логотип Mojang'];
        $this->patterns = ['gra', 'gru', 'bri', 'hh','hhb','vh','vhr','ts','bs','ls','rs','ld','rud','lud','rd','cr','dls','drs','sc','cs','ms','tl','bl','tr','br','tt','bt','mr','mc','bts','tts','ss','bo','cbo','flo','cre','sku','moj'];
	}
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		$player = $sender->getName();
		switch($command->getName()){
            case "banner":
                if(isset($args[0])){
                    if(!in_array(strtoupper($args[0]), $this->colors)){
                        $sender->sendMessage('§4Цвет ' . $args[0] . ' не найден, есть такие цвета:§r §0black§r, §2dark_green§r, §3dark_aqua§r, §5dark_purple§r, §6orange§r, §7gray§r, §8dark_gray§r, §9blue§r, §agreen§r, §baqua§r, §cred§r, §dlight_purple§r, §eyellow§r, §fwhite§r.');
                    }else{ 
                        $this->$player =  new \stdClass(); 
                        $this->layer($sender, strtolower($args[0]));
                    }
			    }else{
				    $sender->sendMessage('§4Пожалйста, выберите цвет заднего фона:§r §0black§r, §2dark_green§r, §3dark_aqua§r, §5dark_purple§r, §6orange§r, §7gray§r, §8dark_gray§r, §9blue§r, §agreen§r, §baqua§r, §cred§r, §dlight_purple§r, §eyellow§r, §fwhite§r.');
			    }
			default:
				return false;
        }
        
	}
    public function layer($player, $color, $all = false){
       $form = new SimpleForm(function (Player $player, $data = null) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                default:
                    $playern = $player->getName();
                    if($this->$playern->all === false){
                        $selected = $result;
                    }elseif($result == 0){
                        $playern = $player->getName();
                        $to_text = '§'.$this->colortags[strtoupper($this->$playern->color)]."Edited ".$this->$playern->color." banner";  //TODO: pattern to name
                        $player->sendMessage("§aГотово! Сгенерированное название баннера: §r" . $to_text);
                        $item = Item::fromString("minecraft:banner:".$this->bannerc[strtoupper($this->$playern->color)]);
                        $item->setCount(16);
                        $item->setNamedTag(JsonNbtParser::parseJSON("{display:{Name:".$to_text."},BlockEntityTag:{Base:".$this->bannerc[strtoupper($this->$playern->color)].",Patterns:[".substr($this->$playern->all, 0, -1)."]}}"));
                        $player->getInventory()->addItem($item);
                        $this->$playern->color = null;
                        $this->$playern->all = null;
                        $this->$playern->pattern = null;
                        return;
                    }else{
                        $selected = $result-1;
                    }
                    $this->color($player, $this->$playern->color, $this->$playern->all, $selected);
                    return;
            }
        });
        $colortag = '§'.$this->colortags[strtoupper($color)];
        $form->setTitle("Создание $colortag"."$color §rфлаг");
        $form->setContent("Выберите узор");
        if($all !== false) $form->addButton("§k|-| §rГотово");
        foreach($this->items as $item){
            $form->addButton($item);
        }
        $playern = $player->getName();
        $this->$playern->color = $color;
        $this->$playern->all = $all;
        $form->sendToPlayer($player);
    }
    public function color($player, $color, $all, $pattern){
       $form = new SimpleForm(function (Player $player, $data = null ) {
            $result = $data;
            if ($result === null) {
                return true;
            }
            $playern = $player->getName();
            $this->$playern->all .=  '{Pattern:' . $this->patterns[$this->$playern->pattern] . ',Color:' . $this->bannerc[$this->colors[$result]].'},';
            $this->layer($player, $this->$playern->color, $this->$playern->all);
            return;
        });
        $colortag = '§'.$this->colortags[strtoupper($color)];
        $form->setTitle("Создание $colortag"."$color §rфлага");
        $form->setContent("Выберите цвет узора: §l" . $this->items[$pattern]);
        foreach($this->colors as $item){
            $form->addButton('§'.$this->colortags[$item] . ucfirst(strtolower(str_replace('_', ' ', $item))));
        }
        $playern = $player->getName();
        $this->$playern->pattern = $pattern;
        $form->sendToPlayer($player);
    }
}
