<?php

include_once './config.php';



print('<link rel="stylesheet" type="text/css" href="' . HOST . '/public/css/modulos.css">');
print('<title>Temas</title>');
//print('<script src="' . HOST . '/public/js/game/game.js"></script>');

//container bootstrap


if (isset($_SESSION['usuario_validado'])) {


   print('</div><br><br> 
  <!-- Trigger the modal with a button -->
<div style="padding: 20px;"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Unidad 1</button>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Unidad 2</button>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal3">Unidad 3</button>
</div>

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">


    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unidad 1</h4>
      </div>
      <div class="modal-body">
        <p><h4>Metodologías ágiles</h4><br><br>
		En las últimas décadas, la estructura y la gestión de los proyectos dentro de las organizaciones se ha vuelto más compleja con el uso de nuevas herramientas, tecnologías, equipos de trabajo dispersos en diferentes lugares a distancia, instantaneidad en el acceso a la información, etc. Ante un contexto diferente, resulta cada vez más complejo obtener resultados favorables utilizando las herramientas de gestión tradicionales, ya que no se adaptan a las nuevas expectativas de los usuarios y a las exigencias del mercado.<br>
		La necesidad de implementar procedimientos que permitan entregar productos de calidad con los costes y tiempos pactados ha llevado al desarrollo de nuevas metodologías para la gestión de equipos y proyectos.
		El desarrollo ágil de software envuelve un enfoque de desarrollo iterativo e incremental, donde los requisitos y soluciones evolucionan con el tiempo según la necesidad del proyecto. Así el trabajo es realizado mediante la colaboración de equipos auto - organizados y multidisciplinarios, inmersos en un proceso compartido de toma de decisiones a corto plazo.
		Las metodologías ágiles son aquellas metodologías de gestión que permiten adaptar la forma de trabajo al contexto y naturaleza de un proyecto, basándose en la flexibilidad y la inmediatez, y teniendo en cuenta las exigencias del mercado y los clientes. Los pilares fundamentales de las metodologías ágiles son el trabajo colaborativo y en equipo.
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>


</div>
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">


    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unidad 2</h4>
      </div>
      <div class="modal-body">
        <p><h4>Desarrollo de Software Adaptativo</h4><br>
		<h6>(Abreviaremos la metodología en este sitio como DAS)</h6><br>
		La técnica de Desarrollo de Software Adaptativo o Desarrollo Adaptativo de Software (Adaptive software Development), fue desarrollada por Jim Highsmith y Sam Bayer en 1998, como una técnica para construir software y sistemas complejos. Su apoyo filosófico se enfoca en la colaboración humana y la organización propia del equipo. 
		DAS proporciona un marco para el desarrollo iterativo de sistemas grandes y complejos. El método fomenta el desarrollo iterativo e incremental con el uso de prototipos.
		DAS resalta que las aproximaciones secuenciales en cascada solo funcionan en entornos bien conocidos. Pero como los cambios ocurren frecuentemente en el desarrollo software, es importante usar un método tolerante a cambios. El primer ciclo de un proyecto DAS suele ser corto, asegurando que el cliente está involucrado y confirmando la viabilidad del proyecto.
		Cada ciclo termina con una revisión en grupo enfocada al cliente. Durante las reuniones de revisión, se estudia la aplicación funcionando. El resultado de las reuniones son peticiones de cambio documentadas.<br> <br>
		<h5>Antecedentes</h5><br>
		La definición moderna de desarrollo ágil de software evolucionó a mediados de la década de 1990 como parte de una reacción contra los métodos tradicionales, muy estructurados y estrictos, extraídos del modelo de desarrollo en cascada. <br>
		Los métodos de desarrollo ágiles e iterativos pueden ser vistos como un retroceso a las prácticas observadas en los primeros años del desarrollo de software (aunque en ese tiempo no había metodologías para hacerlo). En el año 2001, miembros prominentes de la comunidad se reunieron en Snowbird, Utah, y adoptaron el nombre de "métodos ágiles". Poco después, algunas de estas personas formaron la "alianza ágil", una organización sin fines de lucro que promueve el desarrollo ágil de aplicaciones. <br>
		Página web de la organización: https://www.agilealliance.org/
		Muchos métodos similares al ágil fueron creados antes del 2000. Entre los más notables se encuentran: Scrum (1986), Crystal Clear <br>(cristal transparente), Programación Extrema (en inglés eXtreme Programming o XP, 1996), Desarrollo de Software Adaptativo (1998), Feature Driven Development, Método de desarrollo de sistemas dinámicos (Dynamic Systems Development Method o DSDM, 1995).<br>

		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>


</div>
<!-- Modal -->
<div id="myModal3" class="modal fade" role="dialog">


    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Unidad 3</h4>
      </div>
      <div class="modal-body">
        <p><h4> Fases del Desarrollo Adaptativo de Software</h4> <br>
		El ciclo de vida del DAS se conforma de tres fases: Especulación, colaboración y aprendizaje.<br>
		<h5>Especulación</h5> <br>
		En la fase de especulación se inicia el desarrollo del proyecto. Es una primera fase de iniciación para establecer los principales objetivos y metas del proyecto en su conjunto y comprender las limitaciones (zonas de riesgo) con las que operará el proyecto.
		En ella se utiliza información como la misión del cliente, las restricciones del proyecto y los requisitos básicos para definir el conjunto de ciclos en el que se harán los incrementos del software.<br> 
		En DAS se realizan estimaciones de tiempo sabiendo que pueden sufrir desviaciones. Sin embargo, estas son necesarias para la correcta atención de los trabajadores que se mueven dentro de plazos de forma que puedan priorizar sus tareas.
		Se decide el número de iteraciones para consumir el proyecto, prestando atención a las características que pueden ser utilizadas por el cliente al final de la iteración. Son por tanto necesarios, marcar objetivos prioritarios dentro de las mismas iteraciones.
		Estos pasos se pueden volver a examinar varias veces antes de que el equipo y los clientes están satisfechos con el resultado.<br>
		En el Desarrollo Adaptivo de Software el término planificar se reemplaza por el término especular. Mientras se especula, el equipo no abandona la planificación, pero reconoce la realidad de la incertidumbre en problemas complejos. Especular alienta la exploración y la experimentación. Se alientan las iteraciones con ciclos cortos.<br>
		<h5>Colaboración</h5> <br>
		Es la fase donde se centra la mayor parte del desarrollo manteniendo una componente cíclica. Un trabajo importante es la coordinación que asegure que lo aprendido por un equipo se transmite al resto y no tenga que volver a ser aprendido por los otros equipos. <br>
		Para la fase de colaboración se busca que el equipo no solo se comunique o se encuentre completamente integrado, se desea que exista confianza, donde se puedan realizar críticas constructivas y ayudar si resentimientos, trabajar tan duro como sea posible, comunicar de una forma oportuna los problemas que se presenten para tomar acciones efectivas y poseer un conjunto de actitudes que contribuyan al trabajo que se encuentran realizando.<br>
		Las aplicaciones complejas no se construyen, evolucionan. Las aplicaciones complejas requieren que se recopile, analice y aplique un gran volumen de información al problema. Los entornos turbulentos tienen altas tasas de flujo de información. Por lo tanto, las aplicaciones complejas requieren que se recopile, analice y aplique un gran volumen de información al problema. Esto da como resultado diversos requisitos de conocimiento que solo pueden ser manejados por colaboración de equipo.
		Colaborar requeriría la capacidad de trabajar conjuntamente para producir resultados, compartir conocimientos o tomar decisiones.<br>
		<h5>Aprendizaje </h5><br>
		La última etapa termina con una serie de ciclos de colaboración, su trabajo consiste en capturar lo que se ha aprendido, tanto positivo como negativo. Es un elemento crítico para la eficacia de los equipos. 
		El aprendizaje permite mejorar el entendimiento real sobre la tecnología, los procesos utilizados y el proyecto. El aprendizaje individual permite al equipo tener mayor posibilidad de éxito.
		Esta fase del ciclo de vida es vital para el éxito del proyecto. El equipo debe mejorar su conocimiento constantemente, utilizando prácticas como:<br>
		<ul>
		<li> - Revisiones Técnicas</li>
		<li> - Retrospectivas del proyecto</li>
		<li> - Grupos de enfoque al cliente</li>
		</ul>
		Las revisiones deben hacerse después de cada iteración. Ambos, los desarrolladores y los clientes examinan sus suposiciones y usan los resultados de cada ciclo de desarrollo para aprender la dirección del siguiente. El equipo aprende:<br>
		<ul>
		<li> - Acerca de los cambios de producto</li>
		<li> - Cambios más fundamentales en las suposiciones subyacentes sobre cómo se están desarrollando los productos.</li>
		</ul>
	
		Las iteraciones deben ser cortas, para que el equipo pueda aprender de errores pequeños en lugar de grandes.
		En esta etapa se identifican cuatro tipos de aprendizaje:<br>
		<ul>
		<li> - <b>Calidad del producto desde un punto de vista del cliente.</b> Es la única medida legítima de éxito, pero, además dentro de las metodologías ágiles, los clientes tienen un valor importante.</li>
		<li> - <b>Calidad del producto desde un punto de vista de los desarrolladores.</b> Se trata de la evaluación de la calidad de los productos desde un punto de vista técnico. Ejemplos de esto incluyen la adhesión a las normas y objetivos conforme a la arquitectura.</li>
		<li> - <b>La gestión del rendimiento.</b> Este es un proceso de evaluación para ver lo que se ha aprendido mediante el empleo de los procesos utilizados por el equipo.</li>
		<li> - <b>Situación del proyecto.</b> Como paso previo a la planificación de la siguiente iteración del proyecto, es el punto de partida para la construcción de la siguiente serie de características.</li>
		</ul>

		<h5>Especular - Colaborar - Aprender el ciclo como un todo</h5><br>
		El ciclo Especular-Colaborar-Aprender que hemos visto no es lineal, las tres fases se superponen.
		Se observa lo siguiente desde el marco Adaptativo.<br>
		<ul>
		<li> - Es difícil colaborar sin aprender o aprender sin colaborar.</li>
		<li> - Es difícil especular sin aprender o aprender sin especular.</li>
		<li> - Es difícil especular sin colaborar o colaborar sin especular.</li>

		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>


</div>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
$(document).on("hidden.bs.modal", function (e) {
    var target = $(e.target);
    target.removeData("bs.modal")
    .find(".clearable-content").html("");
});
</script>
');


} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}

//fin del container de bootstrap

?>