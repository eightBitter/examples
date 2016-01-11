<!DOCTYPE html>
<html>
  <head>
    <title>Linked Data Examples | Series 001</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="alternate" type="application/rdf+xml" href="http://jacobshelby.org/examples/linkedData/catalog_001.rdf">
    <link rel="shortcut icon" href="http://jacobshelby.org/favicon.ico" type="image/x-icon">
    <link rel="icon" href="http://jacobshelby.org/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="http://jacobshelby.org/css.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>
  </head>
<?php
    /**
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    set_include_path(get_include_path() . PATH_SEPARATOR . '../../easyrdf/lib/');
    require_once "EasyRdf.php";
?>


<body>
  <header>
    <div id="header">
      <h1><a href="http://jacobshelby.org">Jacob Shelby</a></h1>
      <a href="http://metaman.org" target="_blank"><img src="http://jacobshelby.org/images/metaman-4.png" id="mascot"></a>

      <aside id="social">
        <a href="https://twitter.com/jacob_shelby421" target="_blank"><img src="http://jacobshelby.org/images/twitter64.png" class="social-icons"></a>
        <a href="http://github.com/eightBitter" target="_blank"><img src="http://jacobshelby.org/images/github64.png" class="social-icons"></a>
        <a href="https://www.linkedin.com/profile/view?id=295963794" target="_blank"><img src="http://jacobshelby.org/images/linkedin64.png" class="social-icons"></a>
      </aside>
    </div>

    <nav id="top-menu">
      <ul>
        <li><a href="http://jacobshelby.org">About</a></li>
        <li><a href="http://jacobshelby.org/projects">Projects</a></li>
        <li><a href="http://jacobshelby.org/scholarship">Scholarship</a></li>
        <li><a href="http://jacobshelby.org/cv" target="_blank">CV</a></li>
      </ul>
    </nav>
  </header>


<?php

        ## Add namespaces. At default easyRdf recognizes dcterms, dc, foaf, rdf, rdfs, and some others
        EasyRdf_Namespace::set('madsrdf', 'http://www.loc.gov/mads/rdf/v1#');
        EasyRdf_Namespace::set('bibframe', 'http://bibframe.org/vocab/');
        EasyRdf_Namespace::set('gn', 'http://www.geonames.org/ontology#');
        EasyRdf_Namespace::set('skos', 'http://www.w3.org/2008/05/skos#');
        EasyRdf_Namespace::set('lexvo', 'http://lexvo.org/id/');
        EasyRdf_Namespace::set('lexvont', 'http://lexvo.org/ontology#');
        EasyRdf_Namespace::set('schema', 'http://schema.org/');

        ##Create preliminary resources
        $graph = EasyRdf_Graph::newAndLoad('http://jacobshelby.org/examples/linkedData/Series_001.rdf');
        $base = 'http://jacobshelby.org/examples/linkedData/';
        // ____ = $graph->resource($base.'____');



        /*$book = $graph->resource('http://jacobshelby.org/examples/linkedData/catalog_001');
        $language = $book->get('dcterms:language');
        $placeOfPublication = $book->get('bibframe:providerPlace');
        $placeOfPublicationResource = $placeOfPublication."about.rdf";
        $placeOfPublicationGraph = EasyRdf_Graph::newAndLoad($placeOfPublicationResource);
        $placeOfPublicationRecord = $placeOfPublicationGraph->resource($placeOfPublication);
        $type = $book->get('dcterms:type');
        $typeGraph = EasyRdf_Graph::newAndLoad('http://dublincore.org/2012/06/14/dctype.rdf');
        $typeRecord = $typeGraph->resource($type); */
?>


<main>
  <h1>Linked data finding aid example</h1>
  <section class="content-box">
    <!-- metadata about the "resouce", in this case, the original book "Moby Dick, or, the Whale"-->
    <h2>Series 001</h2>

  <?php
    $dump = $graph->dump('html');
    print $dump;
  ?>
  </main>

  <footer>
      <p id="credits">Header design inspired by <a href="http://owl.cs.manchester.ac.uk/" target="_blank">OWL @ Manchester's design</a>.</p>
      <a rel="license" href="http://creativecommons.org/licenses/by/4.0/" target="_blank"><img alt="Creative Commons License" src="https://i.creativecommons.org/l/by/4.0/88x31.png" id="license" /></a>
  </footer>

  <script src="jquery.details.js"></script>
  <script>
			window.console || (window.console = { 'log': alert });
			$(function() {

				// Add conditional classname based on support
				$('html').addClass($.fn.details.support ? 'details' : 'no-details');

				// Show a message based on support
				// $('body').prepend($.fn.details.support ? 'Native support detected; the plugin will only add ARIA annotations and fire custom open/close events.' : 'Emulation active; you are watching the plugin in action!');

				// Emulate <details> where necessary and enable open/close event handlers
				$('details').details();

				// Bind some example event handlers
				$('details').on({
					'open.details': function() {
						console.log('opened');
					},
					'close.details': function() {
						console.log('closed');
					}
				});

			});
		</script>
</body>
</html>
