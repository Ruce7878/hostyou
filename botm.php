<?php  include("gz.php");
function bot($us,$text){
$sex = $row["sex"];
$bot_text='';
//текст приветствия
$hello_text[]= ' Привет, '.$us.'! Как Zизнь?';
$hello_text[]= ' Привет, чувак!';
$hello_text[]= ' Даров-даров :)';
$hello_text[]= ' Здоровее видали :)';
$hello_text[]= ' Опа! НеуZ-то это ты? Даров!!!';
$hello_text[]= ' Дрям!';
$hello_text[]= ' Здравствуй!';
$hello_text[]= ' Ты во время '.$us.'! Я как раз искал того кто сосать у меня хуй будет:)';
//ответы на вопросы
$quest_text[]= ' Эээ... '.$us.', а ты разве не знаешь?';
$quest_text[]= ' В чате..базарю..';
$quest_text[]= ' Не скаZу :)';
$quest_text[]= ' Догадайся :)';
$quest_text[]= ' Все вопросы к админам :)';
$quest_text[]= ' Ты лучше скаZи, кто виноват и что делать?';
$quest_text[]= ' Нууу...не знаю...';
$quest_text[]= ' Надо подумать..';
$quest_text[]= ' Ну и вопросики у тебя...';
$quest_text[]= ' Секрет :)';
$quest_text[]= ' Как бы это сказать...';
$quest_text[]= ' Не знаю..';
$quest_text[]= ' *Думаю*';
$quest_text[]= ' А как ты думаешь?';
$quest_text[]= ' Не хочу сейчас об этом говорить';
$quest_text[]= ' Давай попозZе, а?';
$quest_text[]= ' Отстань!';
$quest_text[]= ' Зачем тебе это?';
$quest_text[]= ' Тебе от этого легче станет?';
$quest_text[]= ' Подумай :)';
$quest_text[]= ' А какая тебе разница?';

//отвечаем на вопросы со временем :)
$time_text[]= date("d.m.Y-H:i:s").'.';
$time_text[]= ' Гг :) точное время '.date("d.m.Y-H:i:s").'.';
$time_text[]= ' Часов '.date("H").', а минут не скаZу.';
$time_text[]= date("H:i:s").'.';
$time_text[]= ' Московское время '.date("H:i:s").'.';

//отвечаем на обзывания
$mat_text[]= ' За такое и по морде моZно схлопотать...';
$mat_text[]= ' Кто? Ты?';
$mat_text[]= ' Не обзывайся!';
$mat_text[]= ' Слушай, иди отсюда, а?';
$mat_text[]= ' Эй, куда смотрят модераторы?';
$mat_text[]= ' Эй, не наглей!';

//отвечаем на намеки об искуственном происхоZдении
$robot_text[]= ' Во мне есть и человеческая сущность...';
$robot_text[]= ' Ну да, я из Матрицы, а что?';
$robot_text[]= ' Я не робот!';
$robot_text[]= ' Я не робот, я только учусь!';
$robot_text[]= ' Кто тут бот? Нету тут никакого бота';
$robot_text[]= ' Не, я тоZе Zивой.';

//если нарисовали смайлик
$smile_text[]= ' Эт че за смайлик?';
$smile_text[]= ' А я не умею смайлы рисовать :(';
$smile_text[]= ' Прикольный смайлик :)';
$smile_text[]= ' Эт че за картинка?';
$smile_text[]= ' Блин, не надо картинок, трафик денег стоит!';
$smile_text[]= ' Смайлик :)';

//про викторину
$vict_text[]= ' Ну пришел я к вам из викторины и что?';
$vict_text[]= ' А мне тут нравится :)';
$vict_text[]= ' Просто в викторине скучно :)';
$vict_text[]= ' Надоело мне задавать вопросы, хочу общаться :)';
$vict_text[]= ' Слушай, а давай ты поработаешь вместо меня в викторине?';
$vict_text[]= ' Не хочу я больше быть умником :)';

//про лубоф
$love_text[]= ' Я тя лублу :)';
$love_text[]= ' Меня много кто любит)))';
$love_text[]= ' Ох, лубоф :)';
$love_text[]= ' Любить..и быть любимым..что стоит это чувство?';
$love_text[]= ' Любишь...меня?';
$love_text[]= ' Люби меня :)';

//предлоZения поговорить
$talk_text[]= ' И чего Z тебе рассказать?';
$talk_text[]= ' Не знаю что и сказать...';
$talk_text[]= ' Гг :) и о чем тебе рассказать?';
$talk_text[]= ' Из меня плохой рассказчик :)';
$talk_text[]= ' Рассказывать? Неее...';
$talk_text[]= ' Не хочу :)';

//как зовут
$name_text[]= ' Ну ладно :) Я Тупица, а ты кто?) НеуZели '.$us.'?';
$name_text[]= ' Ладно...Так уZ и быть :) Тупица я!';
$name_text[]= ' Гг))) ну ок, я Тупица :)';
$name_text[]= ' А впрочем, Медиум меня Тупицой нарек...';

//циферки
$numeric_text[]= ' Че это за циферки?';
$numeric_text[]= ' Я не умею считать!';
$numeric_text[]= ' Извини, алгебра 2 :(';
$numeric_text[]= ' Отстань!';

if(ereg('ривет|даров|рям|дравствуй|чмак|Чмак|рива|драствуй|драсти|расти',$text))
	{
	$rand=rand(0,count($hello_text)-1);
	$bot_text = $hello_text[$rand];
	$e1=true;
	}
if(ereg('елаешь|где|чем|очему|как|огда|кто|Кто|Как|тветь|твечай|колько|Где|акой|акая|акие|че|овут|куда|делай',$text))
	{
	$rand=rand(0,count($quest_text)-1);
	$bot_text .=' '.$quest_text[$rand];
	$e2=true;
	}
if(ereg('ремя|час|Час|дата|Дата|исло|емени',$text))
	{
	$rand=rand(0,count($time_text)-1);
	$bot_text .=' '.$time_text[$rand];
	$e3=true;
	}
if(ereg('удак|изда|уй|бля|Бля|издец|тупой|Тупой|ебок|ебать|Ебать|еби|Еби|соси|Соси|издуй|овно|ерьмо|урак|лупый|уя|нахуя',$text))
	{
	$rand=rand(0,count($mat_text)-1);
	$bot_text .=' '.$mat_text[$rand];
	$e4=true;
	}
if(ereg('бот|Бот|атрица|Нео|нео|ринити|орфеус|иборг',$text))
	{
	$rand=rand(0,count($robot_text)-1);
	$bot_text .=' '.$robot_text[$rand];
	$e5=true;
	}
if(ereg('\.+[a-z]+\.',$text))
	{
	$rand=rand(0,count($smile_text)-1);
	$bot_text .=' '.$smile_text[$rand];
	$e6=true;
	}
if(ereg('икторина|мник|опрос|лазнет',$text))
	{
	$rand=rand(0,count($vict_text)-1);
	$bot_text .=' '.$vict_text[$rand];
	$e7=true;
	}
if(ereg('люби|Люби|любл|Любл',$text))
	{
	$rand=rand(0,count($love_text)-1);
	$bot_text .=' '.$love_text[$rand];
	$e8=true;
	}
if(ereg('оговор|скаZи|СкаZи|сказ',$text))
	{
	$rand=rand(0,count($talk_text)-1);
	$bot_text .=' '.$talk_text[$rand];
	$e9=true;
	}
if(ereg('имя|Имя|зовут|Зовут',$text))
	{
	$rand=rand(0,count($name_text)-1);
	$bot_text .=' '.$name_text[$rand];
	$e10=true;
	}
if(ereg('[0-9]',$text))
	{
	$rand=rand(0,count($numeric_text)-1);
	$bot_text .=' '.$numeric_text[$rand];
	$e11=true;
	}

if(!$e1 && !$e2 && !$e3 && !$e4 && !$e5 && !$e6 && !$e7 && !$e8 && !$e9 && !$e10 && !$e11){
if(!empty($text)){
$rand=rand(1,mysql_result(mysql_query("select count(id) from `bot_dialog_m`;"),0));
list($bot_text)=mysql_fetch_array(mysql_query("select message from `bot_dialog_m` where id='".$rand."';"));
}
else $bot_text='';
}
return $bot_text;
}
?>