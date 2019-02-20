<?php

namespace Language;

class Spanish {

	// Name of this language
	public $name = 'es';
	
	// Number formatting
	public $dpoint = ',';
	public $tseparator = '.';

	private $strings = array(
		'page_title' => 'Panda Investing Club - informacion club30 y alertas para invertir en bolsa',
		'page_keywords' => 'panda inversi�n bolsa acci�nes alertas',
		'page_description' => 'Panda investing club - Panda investing club - el primer club online para invertir en bolsa. Consejos y alertas para maximizar sus inversi�nes.',
		'require_js' => 'Esta p�gina requiere JavaScript',

		'yes' => 'S�',
		'no' => 'No',
		'cancel' => 'Cancelar',
		'go_back' => 'volver',

		'panda_free_tab' => 'Panda',
		'panda_pro_tab' => 'Panda Pro',
		'panda_club30_tab' => 'Panda Club30',

		'how_it_works' => '�C�mo funciona?',
		'email' => 'Correo electr�nico',
		'password_o' => 'Contrase�a (opcional)',
		'send' => 'Entrar',
		'bad_email' => 'El correo electr�nico introducido no es valido',
		'no_such_email' => 'El correo electr�nico o contrase�a introducido no es valido.',
		
		// Modal dialogs
		'new_email_title' => '�Cuenta nueva?',
		'email_not_found' => 'El correo electr�nico introducido no se encuentra en nuestra base de datos.',
		'create_new_account1' => '�Desea crear una cuenta nueva con la direcci�n \'',
		'create_new_account2' => '\'?',
		'account_created' => 'Cuenta creada con ex�to',
		'email_sent' => 'Le hemos enviado un correo electr�nico con instrucci�nes para completar el reg�stro en Panda.',
		'check_inbox' => 'Por favor, comprueba su bandeja de entrada.',
		'not_confirmed_title' => "Cuenta sin confirmar",
		'confirm_account1' => 'La cuenta \'',
		'confirm_account2' => '\' est� registrada pero no confirmada.',
		'confirm_check_email' => 'Por favor, comprueba su bandeja de entrada y siga las instrucci�nes para completar su cuenta Panda..',
		'send_another_email' => 'Enviar otro correo',
		'email_resent' => 'Correo enviado',
		'forgot_email' => 'No tengo mi contrase�a...',
		'reset_password_title' => 'Resetear contrase�a',
		'enter_email_for_reset' => 'Introduzca so direccion de correo electronico y le enviaremos instrucci�nes para resetear su contrase�a:',
		'send_email' => 'Enviar',

		'choose_account_title' => 'Crear su cuenta Panda',
		'choose_account_type' => 'Elige su tipo de cuenta:',
		'account_type_free' => 'Cuenta prueba (gratis durante tres meses)',
		'account_type_code' => 'Cuenta VIP, con c�digo de invitaci�n',
		'invitacion_code_prompt' => 'C�digo',
		'create_account' => 'Crear cuenta',

		// Panda free panel
		'free_first_club' => 'El primer club mundial de inversores online',
		'free_robotraders' => 'Inversiones optimizadas 24/7 por nuestros robotraders. Alertas Panda por correo electr�nico y a tel�fonos moviles.',
		'free_enter_email' => 'Introduzca su email para entrar en Panda (es gratis!):',
		
		// Panda pro panel
		'pro_text1' => 'Ofrezca valor a sus clientes con un c�digo personal para darles acceso a Panda m�s los Indices y Materias Primas.',
		'pro_text2' => 'Sus clientes lo disfrutar�n gratuitamente y usted s�lo pagar� 1 Euro al mes por cuenta.',
		'pro_text3' => 'Solicite el acceso y su clave personalizada a:',

		// Panda club30 panel
		'club30_text1' => '"Un caballo gana la carrera por una nariz y el premio es diez veces m�s que el segundo clasificado".',
		'club30_text2' => 'Si La Bolsa es tu carrera, los 30 minutos de ventaja del plan club30 es la nariz que te har� ganar.',
		'join_club30' => '�nase a Club 30',
		'club30_title' => 'Panda Club 30',
		'club30_description' => 'Con Panda Club 30 recibir�s todas las se�ales y alertas Panda 30 minutos antes de la apertura de los mercados. Una gran ventaja para maximizar sus ganacias.',
		'club30_prices' => 'Precios:',
		'club30_months' => 'meses',
		'club30_more_info' => 'M�s info: info@brokerpanda.com',
		
		// Panda school panel
		'panda_school_title' => 'Academia Panda',
		'panda_seminars' => 'nuestros talleres',
		'panda_book' => '"Manual Pr�ctico Para Sobrevivir en Bolsa"',
		'panda_school_1' => '�Quieres aprender mas sobre la bolsa? �Somos los expertos!',
		'panda_school_2' => 'Acude a uno de',
		'panda_school_3' => 'o descargue nuestro libro ',
		
		// Panda books page
		'panda_publications' => 'Publicaci�nes Panda',
		'panda_book_1' => 'Manual pr�ctico que te ayudara a entender los principales puntales b�sicos para la inversi�n en bolsa moderna.',
		'panda_book_2' => 'Te explicamos con palabras llanas y muchos gr�ficos la tecnolog�a que usan grandes inversores para que la apliques lo antes posible.',
		
		//NUEVO DISE�O INDEX.PHP
		'navbar_brand' =>  'Broker Panda - Investing Club',
		'home' =>  'Home',
		'porque' =>  'Por qu� Brokerpanda',
		'pandaacademy' =>  'PandaAcademy',
		'contacto' =>  'Contacto',
		'login' =>  'Login',
		'espanol' =>  'Espa�ol',
		'english' =>  'English',
		'cansado' =>  '�Est�s cansado de perder',
		'tudinero' =>  'tu dinero en La Bolsa?',
		'teavisamos' =>  'Te avisamos cuando comprar, cuando vender y cuando esperar.',
		'empieza' =>  'Nuestros precios',
		'ultima_tecnologia' =>  'La �ltima tecnolog�a en ',
		'inteligencia_artificial' =>  'inteligencia artificial financiera',
		'robots_advisors' =>  'Los �nicos robots advisors en funcionamiento desde 2011.',
		'batir' =>  'Te ayudar�n a batir al mercado, a superar a tus amigos y a ganar dinero',
		'batir2' =>  'continuamente solo siguiendo las se�ales y aprovechando las tendencias.',
		'avisamos' =>  'Te avisamos',
		'cuando_comprar' =>  'cuando comprar, cuando vender y cuando esperar.',
		'alaapertura' =>  'A la apertura de los mercados tendr�s toda la informaci�n en tu email y una push para que puedas aprovecharla al m�ximo.',
		'podras_elegir' =>  'Podr�s elegir entre seguir nuestras selecciones de cada mercado TOP10 o seleccionar tus propias compa��as de ',
		'masde500' =>  'entre m�s de 500 de todo el mundo.',
		'tbcommodityes' =>  ', tambi�n COMMODITYES, FOREX e INDICES.',
		'companies' =>  'Compa�ias',
		'investigacion' =>  'horas de investigaci�n',
		'invertidos_desarrollo' =>  'Invertidos de desarrollo',
		'garantia_devolucion' =>  'Garant�a de devoluci�n',
		'8problemas' =>  '8 problemas de los fondos que no tienes con Brokerpanda',
		'versus' =>  'Fondos de inversi�n versus Brokerpanda',
		'costes' =>  'Costes',
		'cantidad_estudios' =>  'Cantidad de estudios acad�micos concluyen que hay muchos fondos que cobran unas comisiones excesivas, superiores al valor que es capaz de crear el gestor.',
		'duras_penalizaciones' =>  'Duras penalizaciones',
		'si_por_cualquier' =>  'Si por cualquier imprevisto necesitas recuperar tu dinero, Algunos fondos tienen costes muy altos de reembolso, y podr�amos llevarnos alg�n susto a la hora de salir del fondo.',
		'nula' =>  'Nula Liquidez',
		'plazos_marcados' =>  'Con los plazos marcados por los Fondos , entre 3 y 20 a�os, hay que esperar a los posibles beneficios o asumir las penalizaciones correspondientes.',
		'falsa_gestion' =>  'Falsa gesti�n activa',
		'descubren_mas' =>  'Cada vez se descubren m�s fondos que est�n cobrando altas comisiones a los part�cipes, mientras que est�n replicando un �ndice sin hacer nada especial por los mismos.',
		'nula_voz' =>  'Nula voz en la gesti�n',
		'inversor_inteligente' =>  'Cualquier inversor inteligente quiere tener el control absoluto de su dinero para cualquier contingencia, y es algo que los fondos de inversi�n no te pueden dar.',
		'poca_transparencia' =>  'Poca transparencia',
		'algunas_gestoras' =>  'En algunas gestoras no es f�cil conocer los movimientos que han realizado y el porqu� de los mismos, dejando al inversor una vez que ha pagado a la espera de noticias.',
		'nulo_poder' =>  'Nulo poder de decisi�n',
		'muchos_estilos' =>  'Hay muchos  estilos de inversi�n diferentes, pero en los fondos el part�cipe no tiene voz. El gestor marca su forma de invertir, si te gusta bien, y sino tambi�n.',
		'rentabilidad' =>  'Rentabilidad',
		'duda_razonable' =>  'Existe una duda razonable sobre si los fondos en su conjunto son capaces de batir a los mercados. La mayor�a con suerte igualan al �ndice de referencia.',
		'porque_broker' =>  'Porque Broker Panda',
		'nuestra_inteligencia' =>  'Nuestra inteligencia artificial esta configurada para garantizar la m�xima rentabilidad, conozca porque Broker Panda es la mejor herramienta del mercado. ',
		'como_funciona' =>  '�Como funciona?',
		'pro' =>  'PRO',
		'particular' =>  'Inversor particular',
		'semana_euro' =>  'Por semana / Euro',
		'1mercado' =>  '1 MERCADO',
		'atueleccion' =>  ' a TU elecci�n',
		'top10' =>  'TOP 10',
		'top20' =>  'TOP 20',
		'top30' =>  'TOP 30',
		'plus30' =>  'y hasta + 30 compa��as',
		'conlaposibilidad' =>  'desde 10&euro; mas.',
		'garantiadedevolucion' =>  'GARANT�A de devoluci�n',
		'stopsautomaticos' =>  'Stops Autom�ticos 8%',
		'estadisticasdesde' =>  'Estad�sticas desde 2011',
		'emaildiario' =>  'Email diario con las entradas y salidas',
		'pushdesenales' =>  'Push de se�ales a la apertura',
		'posibilidaddeelegir' =>  'Posibilidad de sumar compa��as',
		'rentabilidadestimada' =>  'Rentabilidad estimada del Portfolio',
		'alertasapertura' =>  'Te llegar�n alertas a la apertura mercado',
		'15minantes' =>  'Te llegar�n alertas 15 min ANTES de la apertura mercado',
		'30minantes' =>  'Te llegar�n alertas 30 min ANTES de la apertura mercado',
		'decadamercado' =>  'de cada mercado',
		'1continente' =>  '1 CONTINENTE',
		'todoslosmercados' =>  'TODOS LOS MERCADOS DEL MUNDO',
		'delmundo' =>  'del mundo',
		'goldcontinent' =>  'GOLD CONTINENT',
		'brokersfamily' =>  'Brokers, Family Office',
		'semanaeuro' =>  'Por semana / Euro',
		'comprar' =>  'Comprar',
		'quieresaprender' =>  '�Quieres aprender mas sobre la bolsa?',
		'somosexpertos' =>  '�Somos los expertos!',
		'acude' =>  'Acude a uno de nuestros talleres o descargue nuestro libro',
		'las12claves' =>  '"Las 12 claves de la bolsa".',
		'aprendecon' =>  'Aprende con ',
		'brokerpanda' =>  'Broker Panda',
		'politicacookies' =>  'Pol�tica de Cookies',
		'politicaprivacidad' =>  'Pol�tica de Privacidad',
		'meses' =>  'meses',
		'ano' =>  'a�o',
		'premiumworld' =>  'PREMIUM WORLD',
		'grandesfamily' =>  'Grandes Family Office, Fondos  de Inversi�n',
		'garantiadevolucionons' => 'GARANT�A de devoluci�n de la suscripci�n si no superamos al �ndice de referencia del mercado durantes los �ltimos 12 meses',  
		
		
		//NUEVO DISE�O PORQUE BROKER PANDA.PHP
		'primerclubmundial' =>  'El primer club mundial de inversores online',
		'ventajas' =>  'Ventajas Brokerpanda',
		'algunasventajas' =>  'Algunas de las ventajas que disfrutaras cuando utilizas Brokerpanda.',
		'tanseguros' =>  'Estamos tan ',
		'tanseguros2' =>  'seguros de nuestros resultados',
		'tanseguros3' =>  ' que si no ganamos al mercado con nuestro TOPTEN en un a�o, ',
		'tanseguros4' =>  'te devolvemos las cuotas correspondientes en el caso de que no superemos al �ndice de referencia',
		'tanseguros5' =>  'Cada TOPTEN con su �ndice de referencia.',
		'costesminimos' =>  'Costes m�nimos',
		'lastran1' =>  'Las comisiones altas lastran cualquier buen trabajo de inversi�n, con nosotros obtendr�s las comisiones m�s bajas del mercado operando con DEGIRO e INTERACTIVE BROKERS',
		'lastran2' =>  'Las comisiones altas lastran cualquier buen trabajo de inversi�n, con nosotros obtendr�s las comisiones m�s bajas del mercado con',
		'lastran3' =>  'DEGIRO, INTERACTIVE BROKERS',
		'lastran4' =>  ' y otros.',
		'maximadiversificacion' =>  'M�xima diversificaci�n',
		'libertadparaelegir' =>  'Y libertad para elegir cartera. Puedes elegir el TOPTEN recomendado por nuestro equipo de analistas. O seleccionar las compa��as en las que estas interesado, o las que ya est�s dentro para saber cu�ndo salir.',
		'libertadparaelegircartera' =>  'Y libertad para elegir cartera. ',
		'libertadparaelegircartera1' =>  'Elige el TOPTEN recomendado por nuestro equipo de analistas.',
		'libertadparaelegircartera2' =>  ' O selecciona las compa��as en las que estas interesado, o de las que ya est�s dentro para saber cu�ndo salir.',
		'liquidez' =>  'Liquidez',
		'accesoinmediato' =>  'Acceso inmediato a todo tu dinero.',
		'accesoinmediato2' =>  'En cualquier momento puedes deshacer una posici�n y recuperar tu capital, pues ',
		'accesoinmediato3' =>  't� eres el �nico due�o de tus inversiones.',
		'accesoinmediato4' =>  'Todo lo contrario que un fondo o plazo fijo.',
		'gestionactiva' =>  'Gesti�n activa',
		'serselectivo' =>  'Te permite ser selectivo, ello contribuye a reducir el riesgo. Te damos la posibilidad de que selecciones las compa��as mediante tus propios criterios, nuestra',
		'inteligenciaartificial' =>  'Inteligencia Artificial',
		'teayudaraaganardinero' =>  'te ayudara a ganar dinero.',
		'poderdecision' =>  'Poder de decisi�n',
		'graciasanuestra' =>  'Gracias a nuestra Inteligencia Artificial ',
		'recuperaraselcontrol' =>  'recuperar�s el control de tus inversiones',
		'recuperaraselcontrol2' => '. Con la informaci�n que te proporcionamos t� decides en que compa��a invertir y cuanto. Y adem�s con nuestros partners tendr�s los precios y condiciones m�s ventajosas del mercado.',
		'resultadoshistoricos' => 'Resultados hist�ricos',
		'desde2011' => 'Desde 2011',
		'desde2011-1' => ', estamos registrando, analizando y optimizando los algoritmos que sustentan toda nuestra Inteligencia Artificial. Estos ',
		'desde2011-2' => 'millones de datos',
		'desde2011-3' => ' est�n disponibles para nuestros clientes en forma de las operaciones y sus estad�sticas.',
		'rentabilidad12' => 'Rentabilidad',
		'obtenerpara' => 'Obtenemos para nuestros clientes un rendimiento del 11,7 % anual de media, super�ndolo ampliamente algunos a�os en los mercados de todo el mundo. ',
		'conlosbeneficios' => 'Con los beneficios del inter�s compuesto, nuestros clientes pueden llegar al 100 % en 5 a�os.',
		'losclientesconfeccionan' => 'Los clientes disponen de su TOP10 ,TOP20, TOP30 preseleccionado y pueden ampliar y confeccionar su portafolio adem�s entre las mejores compa��as del mundo. Sobre dicha selecci�n enviaremos nuestros resultados para comprar, vender, mantener/ esperar.',
		'losclientesconfeccionan2' => 'Nuestra Inteligencia Artificial analiza diariamente todas las compa��as y reconocen todos los cambios de tendencia de cada una de ellas, lo compara con los datos hist�ricos para adelantarse a los movimientos del mercado y env�a las alertas a los distintos portafolios de cada cliente.',
		'losclientesconfeccionan3' => 'Recibir�n un e-mail diario que les informar� de las evoluciones y de las alertas correspondientes. Las se�ales de compra y venta de las compa��as solamente aparecer�n un d�a, luego se encuentran en mantener/esperar.',
		'losclientesconfeccionan4' => 'La informaci�n llega a la apertura de los mercados e incluso en preapertura para los planes avanzados. Es muy importante que se ejecuten las ordene en el menor tiempo posible para maximizar tus resultados.',
		'losclientesconfeccionan5' => 'Para a�adir nuevos mercados y compa��as, ver gr�ficos y estad�sticas para ayudarte a la toma de decisiones dispones de su propia �rea persona',
		'losclientesconfeccionan6' => 'Disponen de  toda la informaci�n necesaria en el an�lisis de cada compa��a para ayudarles a la toma de decisiones. Nuestro objetivo es la optimizaci�n de cualquier compa��a en el medio y largo plazo.',
		'losclientesconfeccionan7' => 'En las estad�sticas se puede ver como se han comportado nuestros ROBOTRADERS en el pasado. En uno, dos y cinco a�os.',
		'losclientesconfeccionan8' => 'En los gr�ficos tendr�n una imagen perfecta de cada actuaci�n y comprobar�n nuestro mejor argumento: cortar p�rdidas y dejar correr los beneficios.',
		'losclientesconfeccionan9' => 'En el hist�rico de operaciones comprobar�n el riesgo controlado que asumimos por operaci�n negativa, nunca m�s de un 10%.',
		'losclientesconfeccionan10' => 'Si alguno desea  sacar m�s provecho, disponemos de un  club de Grandes Inversores donde se recibe la informaci�n 30 minutos antes que el resto.',
		
		//NUEVO DISE�O PANDA ACADEMY.PHP
		'losunicoslimites' => 'Consigue gratis las 12 claves de la bolsa',
		'publicacionespanda' => 'Publicaciones Panda',
		'manualpractico' => 'Manual pr�ctico que te ayudara a entender los principales puntales b�sicos para la inversi�n en bolsa moderna.',
		'teexplicamos' => 'Te explicamos con palabras llanas y muchos gr�ficos la tecnolog�a que usan grandes inversores para que la apliques lo antes posible.',
		'descargate' => 'Desc�rgate',
		'nuestrostalleres' => 'Nuestros talleres',
		'acudeaunodenuestros' => 'Acude a uno de nuestros talleres',
		'ahoramismonotenemos' => 'Ahora mismo no tenemos ning�n taller en nuestro calendario, pero s�ganos en las redes sociales para enterarte de todas las novedades.',
		
		//NUEVO DISE�O CONTACTO.PHP
		'envianosunmensaje' => 'Env�anos un mensaje',
		'nombre' => 'Nombre',
		'mensaje' => 'Mensaje',
		'siganos' => 'S�ganos',
		
		//NUEVO DISE�O LOGIN.PHP
		'acceder' => 'Acceder',
		'olvidadomiclave' => 'He olvidado mi clave',
		'notengo' => '�No tienes una cuenta?',
		'nuncaduermen' => 'Nuestros pandas nunca duermen',
		'optimizadas247' => 'Inversiones optimizadas 24/7',
		'pornuestrosrobo' => 'por nuestros robotraders.',
		'alertaspanda' => 'Alertas Panda',
		'porcorreoelectronico' => 'por correo electr�nico y a tel�fonos moviles.',
		'resetpassword' => 'Reset password',
		'introducetucorreo' => 'Introduce tu correo electronico para recibir un vinculo para borrar tu contrase�a:',
		'enviarcorreo' => 'Enviar correo',
		
		//NUEVA CREAR CUENTA.PHP
		'contrasena' => 'Contrase�a',
		'repcontrasena' => 'Repetir contrase�a',
		'yatengo' => 'Ya tengo una cuenta',

		//PREGUNTAS FRECUENTES FAQ.PHP
		'faq' => 'Preguntas Frecuentes',
		'que-es-broker-panda' => 'Que es BROKERPANDA',


	);

	public function get($s) {
		if (array_key_exists($s, $this->strings)) {
      return $this->strings[$s];
    }
		return null;		// Buscar en ingles si no encontramos la frase...
	}
	
}
