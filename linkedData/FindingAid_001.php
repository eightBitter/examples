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
        EasyRdf_Namespace::set('bibframe', 'http://bibfra.me/vocab/lite/');
        EasyRdf_Namespace::set('gn', 'http://www.geonames.org/ontology#');
        EasyRdf_Namespace::set('skos', 'http://www.w3.org/2008/05/skos#');
        EasyRdf_Namespace::set('lexvo', 'http://lexvo.org/id/');
        EasyRdf_Namespace::set('lexvont', 'http://lexvo.org/ontology#');
        EasyRdf_Namespace::set('schema', 'http://schema.org/');

        ##Create preliminary resources
        $graph = EasyRdf_Graph::newAndLoad('http://jacobshelby.org/examples/linkedData/FindingAid_001.rdf');
        $FindingAid_001 = $graph->resource('http://jacobshelby.org/examples/linkedData/FindingAid_001');
        $Collection_001 = $graph->resource('http://jacobshelby.org/examples/linkedData/Collection_001');
        $Series_001 = $graph->resource('http://jacobshelby.org/examples/linkedData/Series_001');
        $Series_002 = $graph->resource('http://jacobshelby.org/examples/linkedData/Series_002');
        $Box_001 = $graph->resource('http://jacobshelby.org/examples/linkedData/Box_001');
        $Box_002 = $graph->resource('http://jacobshelby.org/examples/linkedData/Box_002');
        $Item_001 = $graph->resource('http://jacobshelby.org/examples/linkedData/Item_001');
        $Item_002 = $graph->resource('http://jacobshelby.org/examples/linkedData/Item_002');
        $Item_003 = $graph->resource('http://jacobshelby.org/examples/linkedData/Item_003');

?>


<main>
  <h1>Finding Aid for Collection 001</h1>
  <p><strong>URI:</strong> <a href="http://jacobshelby.org/examples/linkedData/FindingAid_001">http://jacobshelby.org/examples/linkedData/FindingAid_001</a><br/>
    <strong>Visual graph:</strong> <a href="http://en.lodlive.it?http://jacobshelby.org/examples/linkedData/FindingAid_001">link</a><br/>
    <strong>Code:</strong> <a href="https://github.com/eightBitter/examples/tree/master/linkedData/">GitHub</a></p>
  <section class="content-box">

    <h2>
      <?php
        echo "<a href='"."$Collection_001"."'>Collection 001</a>";
      ?>
    </h2>

    <ul>
      <li><strong>Type</strong></li>
      <?php
        $type = $Collection_001->get('rdf:type');
        echo "<li><a href='"."$type"."'>Collection</a></li>";
      ?>

    <ul>
      <li><strong>Title</strong></li>
      <li><?= $Collection_001->get('dcterms:title') ?></li>
    </ul>
    <ul>
      <li><strong>Creator</strong></li>
      <?php
        $creator = $Collection_001->get('dcterms:creator');
        echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
      ?>
    </ul>
    <ul>
      <li><strong>Date</strong></li>
      <li><?= $Collection_001->get('dcterms:date') ?></li>
    </ul>
    <ul>
      <li><strong>Has Series
        <ul>
          <?php
            echo "<li><a href='"."$Series_001"."'>Series 001</a>";
          ?>
            <ul>
              <li><strong>Type</strong></li>
              <?php
                $type = $Series_001->get('rdf:type');
                echo "<li><a href='"."$type"."'>Series</a></li>";
              ?>
            </ul>
            <ul>
              <li><strong>Creator</strong></li>
              <?php
                $creator = $Collection_001->get('dcterms:creator');
                echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
              ?>
            </ul>
            <ul>
              <li><strong>Date</strong></li>
              <li><?= $Collection_001->get('dcterms:date') ?></li>
            </ul>
            <ul>
              <li><strong>Is Part Of</strong></li>
              <?php
                echo "<li><a href='"."$Collection_001"."'>Collection 001</a></li>";
              ?>
            </ul>
            <ul>
              <li><strong>Has Part</strong>
                <ul>
                  <?php
                    echo "<li><a href='"."$Box_001"."'>Box 001</a>";
                  ?>
                    <ul>
                      <li><strong>Type</strong></li>
                      <?php
                        $type = $Box_001->get('rdf:type');
                        echo "<li><a href='"."$type"."'>Box</a></li>";
                      ?>
                    </ul>
                    <ul>
                      <li><strong>Creator</strong></li>
                      <?php
                        $creator = $Collection_001->get('dcterms:creator');
                        echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
                      ?>
                    </ul>
                    <ul>
                      <li><strong>Date</strong></li>
                      <li><?= $Collection_001->get('dcterms:date') ?></li>
                    </ul>
                    <ul>
                      <li><strong>Is Part Of</strong></li>
                      <?php
                        echo "<li><a href='"."$Series_001"."'>Series 001</a></li>";
                      ?>
                    </ul>
                    <ul>
                      <li><strong>Has Part</strong>
                        <ul>
                          <?php
                            echo "<li><a href='"."$Item_001"."'>Item 001</a>";
                          ?>
                            <ul>
                              <li><strong>Type</strong></li>
                              <?php
                                $type = $Item_001->get('rdf:type');
                                echo "<li><a href='"."$type"."'>Item</a></li>";
                              ?>
                            </ul>
                            <ul>
                              <li><strong>Creator</strong></li>
                              <?php
                                $creator = $Item_001->get('dcterms:creator');
                                echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
                              ?>
                            </ul>
                            <ul>
                              <li><strong>Date</strong></li>
                              <li><?= $Item_001->get('dcterms:date') ?></li>
                            </ul>
                            <ul>
                              <li><strong>Is Part Of</strong></li>
                              <?php
                                echo "<li><a href='"."$Series_001"."'>Series 001</a></li>";
                              ?>
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li><strong>Has Series
        <ul>
          <?php
            echo "<li><a href='"."$Series_002"."'>Series 002</a>";
          ?>
            <ul>
              <li><strong>Type</strong></li>
              <?php
                $type = $Series_002->get('rdf:type');
                echo "<li><a href='"."$type"."'>Series</a></li>";
              ?>
            </ul>
            <ul>
              <li><strong>Creator</strong></li>
              <?php
                $creator = $Series_002->get('dcterms:creator');
                echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
              ?>
            </ul>
            <ul>
              <li><strong>Date</strong></li>
              <li><?= $Series_002->get('dcterms:date') ?></li>
            </ul>
            <ul>
              <li><strong>Is Part Of</strong></li>
              <?php
                echo "<li><a href='"."$Collection_001"."'>Collection 001</a></li>";
              ?>
            </ul>
            <ul>
              <li><strong>Has Box</strong>
                <ul>
                  <?php
                    echo "<li><a href='"."$Box_002"."'>Box 002</a>";
                  ?>
                    <ul>
                      <li><strong>Type</strong></li>
                      <?php
                        $type = $Box_002->get('rdf:type');
                        echo "<li><a href='"."$type"."'>Box</a></li>";
                      ?>
                    </ul>
                    <ul>
                      <li><strong>Creator</strong></li>
                      <?php
                        $creator = $Box_002->get('dcterms:creator');
                        echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
                      ?>
                    </ul>
                    <ul>
                      <li><strong>Date</strong></li>
                      <li><?= $Box_002->get('dcterms:date') ?></li>
                    </ul>
                    <ul>
                      <li><strong>Is Part Of</strong></li>
                      <?php
                        echo "<li><a href='"."$Series_002"."'>Series 002</a></li>";
                      ?>
                    </ul>
                    <ul>
                      <li><strong>Has Item</strong>
                        <ul>
                          <?php
                            echo "<li><a href='"."$Item_002"."'>Item 002</a>";
                          ?>
                            <ul>
                              <li><strong>Type</strong></li>
                              <?php
                                $type = $Item_002->get('rdf:type');
                                echo "<li><a href='"."$type"."'>Item</a></li>";
                              ?>
                            </ul>
                            <ul>
                              <li><strong>Creator</strong></li>
                              <?php
                                $creator = $Item_002->get('dcterms:creator');
                                echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
                              ?>
                            </ul>
                            <ul>
                              <li><strong>Date</strong></li>
                              <li><?= $Item_002->get('dcterms:date') ?></li>
                            </ul>
                            <ul>
                              <li><strong>Is Part Of</strong></li>
                              <?php
                                echo "<li><a href='"."$Box_002"."'>Box 002</a></li>";
                              ?>
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <ul>
                      <li><strong>Has Item</strong>
                        <ul>
                          <?php
                            echo "<li><a href='"."$Item_003"."'>Item 003</a>";
                          ?>
                            <ul>
                              <li><strong>Type</strong></li>
                              <?php
                                $type = $Item_003->get('rdf:type');
                                echo "<li><a href='"."$type"."'>Item</a></li>";
                              ?>
                            </ul>
                            <ul>
                              <li><strong>Creator</strong></li>
                              <?php
                                $creator = $Item_003->get('dcterms:creator');
                                echo "<li><a href='"."$creator"."'>Nota Real Person</a></li>";
                              ?>
                            </ul>
                            <ul>
                              <li><strong>Date</strong></li>
                              <li><?= $Item_003->get('dcterms:date') ?></li>
                            </ul>
                            <ul>
                              <li><strong>Is Part Of</strong></li>
                              <?php
                                echo "<li><a href='"."$Box_002"."'>Box 002</a></li>";
                              ?>
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <ul>

  </section>

<hr/>

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
