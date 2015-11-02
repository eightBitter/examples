<!DOCTYPE html>
<html>
  <head>
    <title>Linked Data Examples | Catalog 001</title>
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

    set_include_path(get_include_path() . PATH_SEPARATOR . '../../easyrdf-0.9.0/lib/');
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
        $graph = EasyRdf_Graph::newAndLoad('http://jacobshelby.org/examples/linkedData/catalog_001.rdf');
        $book = $graph->resource('http://jacobshelby.org/examples/linkedData/catalog_001');
        $language = $book->get('dcterms:language');
        $placeOfPublication = $book->get('bibframe:providerPlace');
        $placeOfPublicationResource = $placeOfPublication."about.rdf";
        $placeOfPublicationGraph = EasyRdf_Graph::newAndLoad($placeOfPublicationResource);
        $placeOfPublicationRecord = $placeOfPublicationGraph->resource($placeOfPublication);
        $type = $book->get('dcterms:type');
        $typeGraph = EasyRdf_Graph::newAndLoad('http://dublincore.org/2012/06/14/dctype.rdf');
        $typeRecord = $typeGraph->resource($type);
?>


<main>
  <h1>Linked data catalog example</h1>
  <section class="content-box">
    <!-- metadata about the "resouce", in this case, the original book "Moby Dick, or, the Whale"-->
    <h2>Catalog record 001</h2>

    <p><strong>URI:</strong> <a href="http://jacobshelby.org/examples/linkedData/catalog_001">http://jacobshelby.org/examples/linkedData/catalog_001</a><br/>
      <strong>Visual graph:</strong> <a href="http://en.lodlive.it?http://jacobshelby.org/examples/linkedData/catalog_001">link</a><br/>
      <strong>Code:</strong> <a href="https://github.com/eightBitter/examples/tree/master/linkedData">GitHub</a></p>

    <ul>
      <li><strong>Title</strong></li>
      <li><?= $book->get('dcterms:title') ?></li>
    </ul>
    <ul>
      <li><strong>Creator</strong></li>
      <?php
        //grab the dcterms:creator URLs from the "catalog" record
        foreach ($book->all('dcterms:creator') as $creator) {
        //echo "<li>$creator</li>";

        //create a new graph based on each creator URL (which point to linked data authority records)
        $creatorResource = $creator.".rdf";
        $creatorGraph = EasyRdf_Graph::newAndLoad($creatorResource);
        $creatorRecord = $creatorGraph->resource($creator);

        //pull the madsrdf:authoritativeLabel out of each name authority record
        $creatorLabel = $creatorRecord->get('madsrdf:authoritativeLabel');
        echo "<li><a href='"."$creator"."'>$creatorLabel</a></li>";
        }
      ?>
    </ul>
    <ul>
      <li><strong>Publication date</strong></li>
      <li><?= $book->get('dcterms:date') ?></li>
    </ul>
    <ul>
      <li><strong>Publisher</strong></li>
      <li><?= $book->get('dcterms:publisher') ?></li>
    </ul>
    <ul>
      <li><strong>Place of publication</strong></li>
      <?php
        $placeOfPublicationLabel = $placeOfPublicationRecord->get('gn:name');
        echo "<li><a href='"."$placeOfPublication"."'>$placeOfPublicationLabel</a>";
       ?>
       <details><ul>
           <?php
            $countryCode = $placeOfPublicationRecord->get('gn:countryCode');
            echo "<li><strong>Country code</strong></li>";
            echo "<li>$countryCode</li>";

            $seeAlso = $placeOfPublicationRecord->get('rdfs:seeAlso');
            echo "<li><strong>See also</strong></li>";
            echo "<li><a href='"."$seeAlso"."'>$seeAlso</a></li>";
            ?>
        </details></ul>
      </li>
    </ul>
    <ul>
      <li><strong>Language</strong></li>
      <?php
        //the XML parser didn't like some of the characters that are in this resource's RDF record, so I can't expose the linked data for this one
        echo "<li><a href='"."$language"."'>English</a></li>";
       ?>
    </ul>
    <ul>
      <li><strong>Type of resource</strong></li>
      <?php
      $typeLabel = $typeRecord->get('rdfs:label');
      echo "<li><a href='"."$type"."'>$typeLabel</a>";
       ?>
       <details><ul>
           <?php
            $typeDescription = $typeRecord->get('dcterms:description');
            echo "<li><strong>Description</strong></li>";
            echo "<li>$typeDescription</li>";
            ?>
        </details></ul>
      </li>
    </ul>
    <ul>
      <li><strong>Subject</strong></li>
      <?php
        //grab the dcterms:subject URLs from the "catalog" record
        foreach ($book->all('dcterms:subject') as $subject) {
        //echo "<li>$subject</li>";

        //create a new graph based on each subject URL (which point to linked data authority records)
        $subjectResource = $subject.".rdf";
        $subjectGraph = EasyRdf_Graph::newAndLoad($subjectResource);
        $subjectRecord = $subjectGraph->resource($subject);

        //pull the madsrdf:authoritativeLabel out of each subject authority record
        $subjectLabel = $subjectRecord->get('madsrdf:authoritativeLabel');
        echo "<li><a href='"."$subject"."'>$subjectLabel</a></li>";
        }
      ?>
    </ul>
  </section>

<hr/>

  <section class="content-box">
      <!-- metadata about the RDF document/record that describes the resource -->
      <h2>Provenance of record</h2>

      <?php
        $record = $graph->resource('http://jacobshelby.org/examples/linkedData/catalog_001.rdf');
        $creator = $record->get('dcterms:creator');
       ?>

       <ul>
        <li><strong>Creator</strong></li>
        <?php
          $creatorResource = str_replace("/me", "/jacobShelby.rdf", $creator);
          $creatorGraph = EasyRdf_Graph::newAndLoad($creatorResource);
          $creatorRecord = $creatorGraph->resource($creator);

          $creatorName = $creatorRecord->get('schema:name');
          echo "<li><a href='"."$creator"."'>$creatorName</a>";
         ?>
         <details><ul>
             <?php
              $creatorEmployer = $creatorRecord->get('schema:worksFor');
              $employerRecord = $creatorGraph->resource($creatorEmployer);
              $employerName = $employerRecord->get('schema:name');
              echo "<li><strong>Works for</strong></li>";
              echo "<li><a href='"."$creatorEmployer"."'>$employerName</a></li>";

              $creatorTitle = $creatorRecord->get('schema:jobTitle');
              echo "<li><strong>Job title</strong></li>";
              echo "<li>$creatorTitle</li>";

              $creatorEmail = $creatorRecord->get('schema:email');
              echo "<li><strong>Email</strong></li>";
              echo "<li>$creatorEmail</li>";
              ?>
          </details></ul>
        </li>
      </ul>
      <ul>
        <li><strong>Adaptation of</strong></li>
        <li><a href="<?= $record->get('dcterms:isVersionOf')?>"><?= $record->get('dcterms:isVersionOf')?></a></li>
      </ul>
      <ul>
        <li><strong>Note</strong></li>
        <li><?= $record->get('dcterms:description')?></li>
      </ul>
    </section>
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
				$('body').prepend($.fn.details.support ? 'Native support detected; the plugin will only add ARIA annotations and fire custom open/close events.' : 'Emulation active; you are watching the plugin in action!');

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
