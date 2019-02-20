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
		'page_keywords' => 'panda inversión bolsa acciónes alertas',
		'page_description' => 'Panda investing club - Panda investing club - el primer club online para invertir en bolsa. Consejos y alertas para maximizar sus inversiónes.',
		'require_js' => 'Esta página requiere JavaScript',

		'yes' => 'Sí',
		'no' => 'No',
		'cancel' => 'Cancelar',
		'go_back' => 'volver',

		'panda_free_tab' => 'Panda',
		'panda_pro_tab' => 'Panda Pro',
		'panda_club30_tab' => 'Panda Club30',

		'how_it_works' => '¿Cómo funciona?',
		'email' => 'Correo electrónico',
		'password_o' => 'Contraseña (opcional)',
		'send' => 'Entrar',
		'bad_email' => 'El correo electrónico introducido no es valido',
		'no_such_email' => 'El correo electrónico o contraseña introducido no es valido.',
		
		// Modal dialogs
		'new_email_title' => '¿Cuenta nueva?',
		'email_not_found' => 'El correo electrónico introducido no se encuentra en nuestra base de datos.',
		'create_new_account1' => '¿Desea crear una cuenta nueva con la dirección \'',
		'create_new_account2' => '\'?',
		'account_created' => 'Cuenta creada con exíto',
		'email_sent' => 'Le hemos enviado un correo electrónico con instrucciónes para completar el regístro en Panda.',
		'check_inbox' => 'Por favor, comprueba su bandeja de entrada.',
		'not_confirmed_title' => "Cuenta sin confirmar",
		'confirm_account1' => 'La cuenta \'',
		'confirm_account2' => '\' está registrada pero no confirmada.',
		'confirm_check_email' => 'Por favor, comprueba su bandeja de entrada y siga las instrucciónes para completar su cuenta Panda..',
		'send_another_email' => 'Enviar otro correo',
		'email_resent' => 'Correo enviado',
		'forgot_email' => 'No tengo mi contraseña...',
		'reset_password_title' => 'Resetear contraseña',
		'enter_email_for_reset' => 'Introduzca so direccion de correo electronico y le enviaremos instrucciónes para resetear su contraseña:',
		'send_email' => 'Enviar',

		'choose_account_title' => 'Crear su cuenta Panda',
		'choose_account_type' => 'Elige su tipo de cuenta:',
		'account_type_free' => 'Cuenta prueba (gratis durante tres meses)',
		'account_type_code' => 'Cuenta VIP, con código de invitación',
		'invitacion_code_prompt' => 'Código',
		'create_account' => 'Crear cuenta',

		// Panda free panel
		'free_first_club' => 'El primer club mundial de inversores online',
		'free_robotraders' => 'Inversiones optimizadas 24/7 por nuestros robotraders. Alertas Panda por correo electrónico y a teléfonos moviles.',
		'free_enter_email' => 'Introduzca su email para entrar en Panda (es gratis!):',
		
		// Panda pro panel
		'pro_text1' => 'Ofrezca valor a sus clientes con un código personal para darles acceso a Panda más los Indices y Materias Primas.',
		'pro_text2' => 'Sus clientes lo disfrutarán gratuitamente y usted sólo pagará 1 Euro al mes por cuenta.',
		'pro_text3' => 'Solicite el acceso y su clave personalizada a:',

		// Panda club30 panel
		'club30_text1' => '"Un caballo gana la carrera por una nariz y el premio es diez veces más que el segundo clasificado".',
		'club30_text2' => 'Si La Bolsa es tu carrera, los 30 minutos de ventaja del plan club30 es la nariz que te hará ganar.',
		'join_club30' => 'Únase a Club 30',
		'club30_title' => 'Panda Club 30',
		'club30_description' => 'Con Panda Club 30 recibirás todas las señales y alertas Panda 30 minutos antes de la apertura de los mercados. Una gran ventaja para maximizar sus ganacias.',
		'club30_prices' => 'Precios:',
		'club30_months' => 'meses',
		'club30_more_info' => 'Más info: info@brokerpanda.com',
		
		// Panda school panel
		'panda_school_title' => 'Academia Panda',
		'panda_seminars' => 'nuestros talleres',
		'panda_book' => '"Manual Práctico Para Sobrevivir en Bolsa"',
		'panda_school_1' => '¿Quieres aprender mas sobre la bolsa? ¡Somos los expertos!',
		'panda_school_2' => 'Acude a uno de',
		'panda_school_3' => 'o descargue nuestro libro ',
		
		// Panda books page
		'panda_publications' => 'Publicaciónes Panda',
		'panda_book_1' => 'Manual práctico que te ayudara a entender los principales puntales básicos para la inversión en bolsa moderna.',
		'panda_book_2' => 'Te explicamos con palabras llanas y muchos gráficos la tecnología que usan grandes inversores para que la apliques lo antes posible.',
		
		//NUEVO DISEÑO INDEX.PHP
		'navbar_brand' =>  'Broker Panda - Investing Club',
		'home' =>  'Home',
		'porque' =>  'Por qué Brokerpanda',
		'pandaacademy' =>  'PandaAcademy',
		'contacto' =>  'Contacto',
		'login' =>  'Login',
		'espanol' =>  'Español',
		'english' =>  'English',
		'cansado' =>  '¿Estás cansado de perder',
		'tudinero' =>  'tu dinero en La Bolsa?',
		'teavisamos' =>  'Te avisamos cuando comprar, cuando vender y cuando esperar.',
		'empieza' =>  'Nuestros precios',
		'ultima_tecnologia' =>  'La última tecnología en ',
		'inteligencia_artificial' =>  'inteligencia artificial financiera',
		'robots_advisors' =>  'Los únicos robots advisors en funcionamiento desde 2011.',
		'batir' =>  'Te ayudarán a batir al mercado, a superar a tus amigos y a ganar dinero',
		'batir2' =>  'continuamente solo siguiendo las señales y aprovechando las tendencias.',
		'avisamos' =>  'Te avisamos',
		'cuando_comprar' =>  'cuando comprar, cuando vender y cuando esperar.',
		'alaapertura' =>  'A la apertura de los mercados tendrás toda la información en tu email y una push para que puedas aprovecharla al máximo.',
		'podras_elegir' =>  'Podrás elegir entre seguir nuestras selecciones de cada mercado TOP10 o seleccionar tus propias compañías de ',
		'masde500' =>  'entre más de 500 de todo el mundo.',
		'tbcommodityes' =>  ', también COMMODITYES, FOREX e INDICES.',
		'companies' =>  'Compañias',
		'investigacion' =>  'horas de investigación',
		'invertidos_desarrollo' =>  'Invertidos de desarrollo',
		'garantia_devolucion' =>  'Garantía de devolución',
		'8problemas' =>  '8 problemas de los fondos que no tienes con Brokerpanda',
		'versus' =>  'Fondos de inversión versus Brokerpanda',
		'costes' =>  'Costes',
		'cantidad_estudios' =>  'Cantidad de estudios académicos concluyen que hay muchos fondos que cobran unas comisiones excesivas, superiores al valor que es capaz de crear el gestor.',
		'duras_penalizaciones' =>  'Duras penalizaciones',
		'si_por_cualquier' =>  'Si por cualquier imprevisto necesitas recuperar tu dinero, Algunos fondos tienen costes muy altos de reembolso, y podríamos llevarnos algún susto a la hora de salir del fondo.',
		'nula' =>  'Nula Liquidez',
		'plazos_marcados' =>  'Con los plazos marcados por los Fondos , entre 3 y 20 años, hay que esperar a los posibles beneficios o asumir las penalizaciones correspondientes.',
		'falsa_gestion' =>  'Falsa gestión activa',
		'descubren_mas' =>  'Cada vez se descubren más fondos que están cobrando altas comisiones a los partícipes, mientras que están replicando un índice sin hacer nada especial por los mismos.',
		'nula_voz' =>  'Nula voz en la gestión',
		'inversor_inteligente' =>  'Cualquier inversor inteligente quiere tener el control absoluto de su dinero para cualquier contingencia, y es algo que los fondos de inversión no te pueden dar.',
		'poca_transparencia' =>  'Poca transparencia',
		'algunas_gestoras' =>  'En algunas gestoras no es fácil conocer los movimientos que han realizado y el porqué de los mismos, dejando al inversor una vez que ha pagado a la espera de noticias.',
		'nulo_poder' =>  'Nulo poder de decisión',
		'muchos_estilos' =>  'Hay muchos  estilos de inversión diferentes, pero en los fondos el partícipe no tiene voz. El gestor marca su forma de invertir, si te gusta bien, y sino también.',
		'rentabilidad' =>  'Rentabilidad',
		'duda_razonable' =>  'Existe una duda razonable sobre si los fondos en su conjunto son capaces de batir a los mercados. La mayoría con suerte igualan al índice de referencia.',
		'porque_broker' =>  'Porque Broker Panda',
		'nuestra_inteligencia' =>  'Nuestra inteligencia artificial esta configurada para garantizar la máxima rentabilidad, conozca porque Broker Panda es la mejor herramienta del mercado. ',
		'como_funciona' =>  '¿Como funciona?',
		'pro' =>  'PRO',
		'particular' =>  'Inversor particular',
		'semana_euro' =>  'Por semana / Euro',
		'1mercado' =>  '1 MERCADO',
		'atueleccion' =>  ' a TU elección',
		'top10' =>  'TOP 10',
		'top20' =>  'TOP 20',
		'top30' =>  'TOP 30',
		'plus30' =>  'y hasta + 30 compañías',
		'conlaposibilidad' =>  'desde 10&euro; mas.',
		'garantiadedevolucion' =>  'GARANTÍA de devolución',
		'stopsautomaticos' =>  'Stops Automáticos 8%',
		'estadisticasdesde' =>  'Estadísticas desde 2011',
		'emaildiario' =>  'Email diario con las entradas y salidas',
		'pushdesenales' =>  'Push de señales a la apertura',
		'posibilidaddeelegir' =>  'Posibilidad de sumar compañías',
		'rentabilidadestimada' =>  'Rentabilidad estimada del Portfolio',
		'alertasapertura' =>  'Te llegarán alertas a la apertura mercado',
		'15minantes' =>  'Te llegarán alertas 15 min ANTES de la apertura mercado',
		'30minantes' =>  'Te llegarán alertas 30 min ANTES de la apertura mercado',
		'decadamercado' =>  'de cada mercado',
		'1continente' =>  '1 CONTINENTE',
		'todoslosmercados' =>  'TODOS LOS MERCADOS DEL MUNDO',
		'delmundo' =>  'del mundo',
		'goldcontinent' =>  'GOLD CONTINENT',
		'brokersfamily' =>  'Brokers, Family Office',
		'semanaeuro' =>  'Por semana / Euro',
		'comprar' =>  'Comprar',
		'quieresaprender' =>  '¿Quieres aprender mas sobre la bolsa?',
		'somosexpertos' =>  '¡Somos los expertos!',
		'acude' =>  'Acude a uno de nuestros talleres o descargue nuestro libro',
		'las12claves' =>  '"Las 12 claves de la bolsa".',
		'aprendecon' =>  'Aprende con ',
		'brokerpanda' =>  'Broker Panda',
		'politicacookies' =>  'Política de Cookies',
		'politicaprivacidad' =>  'Política de Privacidad',
		'meses' =>  'meses',
		'ano' =>  'año',
		'premiumworld' =>  'PREMIUM WORLD',
		'grandesfamily' =>  'Grandes Family Office, Fondos  de Inversión',
		'garantiadevolucionons' => 'GARANTÍA de devolución de la suscripción si no superamos al índice de referencia del mercado durantes los últimos 12 meses',  
		
		
		//NUEVO DISEÑO PORQUE BROKER PANDA.PHP
		'primerclubmundial' =>  'El primer club mundial de inversores online',
		'ventajas' =>  'Ventajas Brokerpanda',
		'algunasventajas' =>  'Algunas de las ventajas que disfrutaras cuando utilizas Brokerpanda.',
		'tanseguros' =>  'Estamos tan ',
		'tanseguros2' =>  'seguros de nuestros resultados',
		'tanseguros3' =>  ' que si no ganamos al mercado con nuestro TOPTEN en un año, ',
		'tanseguros4' =>  'te devolvemos las cuotas correspondientes en el caso de que no superemos al índice de referencia',
		'tanseguros5' =>  'Cada TOPTEN con su índice de referencia.',
		'costesminimos' =>  'Costes mínimos',
		'lastran1' =>  'Las comisiones altas lastran cualquier buen trabajo de inversión, con nosotros obtendrás las comisiones más bajas del mercado operando con DEGIRO e INTERACTIVE BROKERS',
		'lastran2' =>  'Las comisiones altas lastran cualquier buen trabajo de inversión, con nosotros obtendrás las comisiones más bajas del mercado con',
		'lastran3' =>  'DEGIRO, INTERACTIVE BROKERS',
		'lastran4' =>  ' y otros.',
		'maximadiversificacion' =>  'Máxima diversificación',
		'libertadparaelegir' =>  'Y libertad para elegir cartera. Puedes elegir el TOPTEN recomendado por nuestro equipo de analistas. O seleccionar las compañías en las que estas interesado, o las que ya estés dentro para saber cuándo salir.',
		'libertadparaelegircartera' =>  'Y libertad para elegir cartera. ',
		'libertadparaelegircartera1' =>  'Elige el TOPTEN recomendado por nuestro equipo de analistas.',
		'libertadparaelegircartera2' =>  ' O selecciona las compañías en las que estas interesado, o de las que ya estés dentro para saber cuándo salir.',
		'liquidez' =>  'Liquidez',
		'accesoinmediato' =>  'Acceso inmediato a todo tu dinero.',
		'accesoinmediato2' =>  'En cualquier momento puedes deshacer una posición y recuperar tu capital, pues ',
		'accesoinmediato3' =>  'tú eres el único dueño de tus inversiones.',
		'accesoinmediato4' =>  'Todo lo contrario que un fondo o plazo fijo.',
		'gestionactiva' =>  'Gestión activa',
		'serselectivo' =>  'Te permite ser selectivo, ello contribuye a reducir el riesgo. Te damos la posibilidad de que selecciones las compañías mediante tus propios criterios, nuestra',
		'inteligenciaartificial' =>  'Inteligencia Artificial',
		'teayudaraaganardinero' =>  'te ayudara a ganar dinero.',
		'poderdecision' =>  'Poder de decisión',
		'graciasanuestra' =>  'Gracias a nuestra Inteligencia Artificial ',
		'recuperaraselcontrol' =>  'recuperarás el control de tus inversiones',
		'recuperaraselcontrol2' => '. Con la información que te proporcionamos tú decides en que compañía invertir y cuanto. Y además con nuestros partners tendrás los precios y condiciones más ventajosas del mercado.',
		'resultadoshistoricos' => 'Resultados históricos',
		'desde2011' => 'Desde 2011',
		'desde2011-1' => ', estamos registrando, analizando y optimizando los algoritmos que sustentan toda nuestra Inteligencia Artificial. Estos ',
		'desde2011-2' => 'millones de datos',
		'desde2011-3' => ' están disponibles para nuestros clientes en forma de las operaciones y sus estadísticas.',
		'rentabilidad12' => 'Rentabilidad',
		'obtenerpara' => 'Obtenemos para nuestros clientes un rendimiento del 11,7 % anual de media, superándolo ampliamente algunos años en los mercados de todo el mundo. ',
		'conlosbeneficios' => 'Con los beneficios del interés compuesto, nuestros clientes pueden llegar al 100 % en 5 años.',
		'losclientesconfeccionan' => 'Los clientes disponen de su TOP10 ,TOP20, TOP30 preseleccionado y pueden ampliar y confeccionar su portafolio además entre las mejores compañías del mundo. Sobre dicha selección enviaremos nuestros resultados para comprar, vender, mantener/ esperar.',
		'losclientesconfeccionan2' => 'Nuestra Inteligencia Artificial analiza diariamente todas las compañías y reconocen todos los cambios de tendencia de cada una de ellas, lo compara con los datos históricos para adelantarse a los movimientos del mercado y envía las alertas a los distintos portafolios de cada cliente.',
		'losclientesconfeccionan3' => 'Recibirán un e-mail diario que les informará de las evoluciones y de las alertas correspondientes. Las señales de compra y venta de las compañías solamente aparecerán un día, luego se encuentran en mantener/esperar.',
		'losclientesconfeccionan4' => 'La información llega a la apertura de los mercados e incluso en preapertura para los planes avanzados. Es muy importante que se ejecuten las ordene en el menor tiempo posible para maximizar tus resultados.',
		'losclientesconfeccionan5' => 'Para añadir nuevos mercados y compañías, ver gráficos y estadísticas para ayudarte a la toma de decisiones dispones de su propia área persona',
		'losclientesconfeccionan6' => 'Disponen de  toda la información necesaria en el análisis de cada compañía para ayudarles a la toma de decisiones. Nuestro objetivo es la optimización de cualquier compañía en el medio y largo plazo.',
		'losclientesconfeccionan7' => 'En las estadísticas se puede ver como se han comportado nuestros ROBOTRADERS en el pasado. En uno, dos y cinco años.',
		'losclientesconfeccionan8' => 'En los gráficos tendrán una imagen perfecta de cada actuación y comprobarán nuestro mejor argumento: cortar pérdidas y dejar correr los beneficios.',
		'losclientesconfeccionan9' => 'En el histórico de operaciones comprobarán el riesgo controlado que asumimos por operación negativa, nunca más de un 10%.',
		'losclientesconfeccionan10' => 'Si alguno desea  sacar más provecho, disponemos de un  club de Grandes Inversores donde se recibe la información 30 minutos antes que el resto.',
		
		//NUEVO DISEÑO PANDA ACADEMY.PHP
		'losunicoslimites' => 'Consigue gratis las 12 claves de la bolsa',
		'publicacionespanda' => 'Publicaciones Panda',
		'manualpractico' => 'Manual práctico que te ayudara a entender los principales puntales básicos para la inversión en bolsa moderna.',
		'teexplicamos' => 'Te explicamos con palabras llanas y muchos gráficos la tecnología que usan grandes inversores para que la apliques lo antes posible.',
		'descargate' => 'Descárgate',
		'nuestrostalleres' => 'Nuestros talleres',
		'acudeaunodenuestros' => 'Acude a uno de nuestros talleres',
		'ahoramismonotenemos' => 'Ahora mismo no tenemos ningún taller en nuestro calendario, pero síganos en las redes sociales para enterarte de todas las novedades.',
		
		//NUEVO DISEÑO CONTACTO.PHP
		'envianosunmensaje' => 'Envíanos un mensaje',
		'nombre' => 'Nombre',
		'mensaje' => 'Mensaje',
		'siganos' => 'Síganos',
		
		//NUEVO DISEÑO LOGIN.PHP
		'acceder' => 'Acceder',
		'olvidadomiclave' => 'He olvidado mi clave',
		'notengo' => '¿No tienes una cuenta?',
		'nuncaduermen' => 'Nuestros pandas nunca duermen',
		'optimizadas247' => 'Inversiones optimizadas 24/7',
		'pornuestrosrobo' => 'por nuestros robotraders.',
		'alertaspanda' => 'Alertas Panda',
		'porcorreoelectronico' => 'por correo electrónico y a teléfonos moviles.',
		'resetpassword' => 'Reset password',
		'introducetucorreo' => 'Introduce tu correo electronico para recibir un vinculo para borrar tu contraseña:',
		'enviarcorreo' => 'Enviar correo',
		
		//NUEVA CREAR CUENTA.PHP
		'contrasena' => 'Contraseña',
		'repcontrasena' => 'Repetir contraseña',
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
