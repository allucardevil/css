<html>
<head>
<!--<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>-->

   <script type="text/javascript">
      function findPrinter() {
         var applet = document.jzebra;
         if (applet != null) {
            // Searches for locally installed printer with "zebra" in the name
            applet.findPrinter("zebra");
         }
         
         // *Note:  monitorFinding() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDoneFinding()" and handle your next steps there.
         monitorFinding();
      }

      function findPrinters() {
         var applet = document.jzebra;
         if (applet != null) {
            // Searches for locally installed printer with "zebra" in the name
            applet.findPrinter("\\{dummy printer name for listing\\}");
         }

         monitorFinding2();
      }

      function print() {
         var applet = document.jzebra;
         if (applet != null) {
            // Send characters/raw commands to applet using "append"
            // Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
            applet.append("A590,1600,2,3,1,1,N,\"jZebra " + applet.getVersion() + " sample.html\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the print() function\"\n");
            applet.append("P1\n");
            
            // Send characters/raw commands to printer
            applet.print();
	 }
	 
         // *Note:  monitorPrinting() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDonePrinting()" and handle your next steps there.
	 monitorPrinting();
         
         /**
           *  PHP PRINTING:
           *  // Uses the php `"echo"` function in conjunction with jZebra `"append"` function
           *  // This assumes you have already assigned a value to `"$commands"` with php
           *  document.jZebra.append(<?php //echo $commands; ?>);
           */
           
         /**
           *  SPECIAL ASCII ENCODING
           *  //applet.setEncoding("UTF-8");
           *  applet.setEncoding("Cp1252"); 
           *  applet.append("\xDA");
           *  applet.append(String.fromCharCode(218));
           *  applet.append(chr(218));
           */
         
      }
      
      
      function printZPLImage() {
         var applet = document.jzebra;
         if (applet != null) {
            // Sample text
            applet.append("^XA\n");
            applet.append("^FO50,50^ADN,36,20^FDPRINTED USING JZEBRA " + applet.getVersion() + "\n"); 
           
            
            // *Note;  As of 2/14/2012, Raw image printing is only supported in
            // ZPLII and ESCP modes, and is an experimental feature.
            // 
            // A second parameter MUST be specified to "appendImage()", for 
            // jZebra to use raw image printing.  If this is not supplied, jZebra
            // will send PostScript data to your raw printer!  This is bad!
            //      - Make sure image width and image height are divisible by 8.
            //      - ESCP image widths should be EXACTLY the pixel width of the
            //           printer according to the ESCP printing guidelines
            //      - ESCP support uses the "ESC V" method.  If "ESC ." is needed
            //           contact the mailing list.
            //      - The applet will append the special raw markup:
            //           i.e. ^GFA, char(27), etc.
            // applet.appendImage("logo.png", "ESCP");
            
            applet.appendImage(getPath() + "img/image_sample_bw.png", "ZPLII");
            while (!applet.isDoneAppending()) {
	      // Note, enless while loops are bad practice.
              // Create a JavaScript function called "jzebraDoneAppending()"
              // instead and handle your next steps there.
	    }
            
            
            // Finish printing
            applet.append("^FS\n");  
            applet.append("^XZ\n");  
            
            // Send characters/raw commands to printer
            applet.print();
	 }
	 
         // *Note:  monitorPrinting() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDonePrinting()" and handle your next steps there.
	 monitorPrinting();
      }


      function print64() {
         var applet = document.jzebra;
         if (applet != null) {
            // Use jZebra's `"append64"` function. This will automatically convert provided
            // base64 encoded text into ascii/bytes, etc.
            applet.append64("QTU5MCwxNjAwLDIsMywxLDEsTiwialplYnJhIHNhbXBsZS5odG1sIgpBNTkwLDE1NzAsMiwzLDEsMSxOLCJUZXN0aW5nIHRoZSBwcmludDY0KCkgZnVuY3Rpb24iClAxCg==");
            
            // Send characters/raw commands to printer
            applet.print();
         }
         
         // *Note:  monitorPrinting() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDonePrinting()" and handle your next steps there.
         monitorPrinting();
      }
      
      function printPages() {
         var applet = document.jzebra;
         if (applet != null) {
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 1\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
            
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 2\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
            
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 3\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
            
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 4\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
            
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 5\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
            
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 6\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
            
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 7\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
            
            applet.append("A590,1600,2,3,1,1,N,\"jZebra 8\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the printPages() function\"\n");
            applet.append("P1\n");
 
            // Mark the end of a label, in this case  P1 plus a newline character
            // jZebra knows to look for this and treat this as the end of a "page"
            // for better control of larger spooled jobs (i.e. 50+ labels)
            applet.setEndOfDocument("P1\n");
            
            // The amount of labels to spool to the printer at a time. When
            // jZebra counts this many `EndOfDocument`'s, a new print job will 
            // automatically be spooled to the printer and counting will start
            // over.
            applet.setDocumentsPerSpool("3");
            
            // Send characters/raw commands to printer
            applet.print();

         }
         
         // *Note:  monitorPrinting() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDonePrinting()" and handle your next steps there.
         monitorPrinting();
      }

      function printXML() {
         var applet = document.jzebra;
         if (applet != null) {
            // Appends the contents of an XML file from a SOAP response, etc.
            // a valid relative URL or a valid complete URL is required for the XML
            // file.  The second parameter must be a valid XML tag/node containing
            // base64 encoded data, i.e. <node_1>aGVsbG8gd29ybGQ=</node_1>
            // Example:
            //     applet.appendXML("http://yoursite.com/zpl.xml", "node_1");
            //     applet.appendXML("http://justtesting.biz/jZebra/dist/epl.xml", "v7:Image");
            applet.appendXML(getPath() + "misc/zpl_sample.xml", "v7:Image");
            
            // Send characters/raw commands to printer
            //applet.print(); // Can't do this yet because of timing issues with XML
         }
         
         // Monitor the append status of the xml file, prints when appending if finished
         // *Note:  monitorAppending() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDoneAppending()" and handle your next steps there.
         monitorAppending();
      }
      
      function printHex() {
      	 var applet = document.jzebra;
         if (applet != null) {
            // Using jZebra's "append()" function, hexadecimanl data can be sent
            // by using JavaScript's "\x00" notation. i.e. "41 35 39 30 2c ...", etc
            // Example: 
            //     applet.append("\x41\x35\x39\x30\x2c"); // ...etc
            applet.append("\x41\x35\x39\x30\x2c\x31\x36\x30\x30\x2c\x32\x2c\x33\x2c\x31\x2c\x31\x2c\x4e\x2c\x22\x6a\x5a\x65\x62\x72\x61\x20\x73\x61\x6d\x70\x6c\x65\x2e\x68\x74\x6d\x6c\x22\x0A\x41\x35\x39\x30\x2c\x31\x35\x37\x30\x2c\x32\x2c\x33\x2c\x31\x2c\x31\x2c\x4e\x2c\x22\x54\x65\x73\x74\x69\x6e\x67\x20\x74\x68\x65\x20\x70\x72\x69\x6e\x74\x48\x65\x78\x28\x29\x20\x66\x75\x6e\x63\x74\x69\x6f\x6e\x22\x0A\x50\x31\x0A");
            
            // Send characters/raw commands to printer
            applet.print();

            
         }
         
         // *Note:  monitorPrinting() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDonePrinting()" and handle your next steps there.
         monitorPrinting();
         
         /**
           *  CHR/ASCII PRINTING:
           *  // Appends CHR(27) + CHR(29) using `"fromCharCode"` function
           *  // CHR(27) is commonly called the "ESCAPE" character
           *  document.jzebra.append(String.fromCharCode(27) + String.fromCharCode(29));
           */
      }
      
      
      function printFile(file) {
      	    var applet = document.jzebra;
      	    if (applet != null) {
	       // Using jzebra's "appendFile()" function, a file containg your raw EPL/ZPL
	       // can be sent directly to the printer
	       // Example: 
	       //     applet.appendFile("http://yoursite/zpllabel.txt"); // ...etc
	       applet.appendFile(getPath() + "misc/" + file);
	       applet.print();
	    }
	    
            // *Note:  monitorPrinting() still works but is too complicated and
            // outdated.  Instead create a JavaScript  function called 
            // "jzebraDonePrinting()" and handle your next steps there.
	    monitorPrinting();
      }


      function printImage(scaleImage) {
            var applet = document.jzebra;
      	    if (applet != null) {
	       // Using jZebra's "appendImage()" function, a png, jpeg file
	       // can be sent directly to the printer supressing the print dialog
	       // Example:
	       //     applet.appendImage("http://yoursite/logo1.png"); // ...etc

               // Sample only: Searches for locally installed printer with "pdf" in the name
               // Can't use Zebra, because this function needs a PostScript capable printer
               applet.findPrinter("\\{dummy printer name for listing\\}");
               while (!applet.isDoneFinding()) {
                    // Note, enless while loops are bad practice.
                    // Create a JavaScript function called "jzebraDoneFinding()"
                    // instead and handle your next steps there.
               }

               // Sample only: If a PDF printer isn't installed, try the Microsoft XPS Document
               // Writer.  Replace this with your printer name.
               var printers = applet.getPrinters().split(",");
               for (i in printers) {
		    if (printers[i].indexOf("Microsoft XPS") != -1 || 
			printers[i].indexOf("PDF") != -1) {
			   applet.setPrinter(i);      
		    }	       
               }
               
               // No suitable printer found, exit
               if (applet.getPrinter() == null) {
                   alert("Could not find a suitable printer for printing an image.");
                   return;
               }

               // Optional, set up custom page size.  These only work for PostScript printing.
               // setPaperSize() must be called before setAutoSize(), setOrientation(), etc.
               if (scaleImage) {
                    applet.setPaperSize("8.5in", "11.0in");  // US Letter
               	    //applet.setPaperSize("210mm", "297mm");  // A4
                    applet.setAutoSize(true);
                    //applet.setOrientation("landscape");
                    //applet.setOrientation("reverse-landscape");
                    //applet.setCopies(3); //Does not seem to do anything
               }

               // Append our image (only one image can be appended per print)
	       applet.appendImage(getPath() + "img/image_sample.png");
	    }

            // Very important for images, uses printPS() insetad of print()
            // *Note:  monitorAppending2() still works but is too complicated and
            // outdated.  Instead create a JavaScript  function called 
            // "jzebraDoneAppending()" and handle your next steps there.
	    monitorAppending2();
      }
      
      function printPDF() {
          var applet = document.jzebra;
      	    if (applet != null) {
               applet.findPrinter("\\{dummy printer name for listing\\}");
               while (!applet.isDoneFinding()) {
                    // Note, enless while loops are bad practice.
                    // Create a JavaScript function called "jzebraDoneFinding()"
                    // instead and handle your next steps there.
               }

               // Sample only: If a PDF printer isn't installed, try the Microsoft XPS Document
               // Writer.  Replace this with your printer name.
               var printers = applet.getPrinters().split(",");
               for (i in printers) {
		    if (printers[i].indexOf("Microsoft XPS") != -1 || 
			printers[i].indexOf("PDF") != -1) {
			   applet.setPrinter(i);      
		    }	       
               }
               
               // No suitable printer found, exit
               if (applet.getPrinter() == null) {
                   alert("Could not find a suitable printer for a PDF document");
                   return;
               }
               
               // Append our pdf (only one pdf can be appended per print)
	       applet.appendPDF(getPath() + "misc/pdf_sample.pdf");
	    }

            // Very important for PDF, uses printPS() instead of print()
            // *Note:  monitorAppending2() still works but is too complicated and
            // outdated.  Instead create a JavaScript  function called 
            // "jzebraDoneAppending()" and handle your next steps there.
	    monitorAppending2();
      }
      
      // Gets the current url's path, such as http://site.com/example/dist/
      function getPath() {
          var path = window.location.href;
          return path.substring(0, path.lastIndexOf("/")) + "/";
      }
      
 
      function printHTML() {
            var applet = document.jzebra;
      	    if (applet != null) {
               applet.findPrinter("\\{dummy printer name for listing\\}");
               while (!applet.isDoneFinding()) {
                   // Wait
               }

               // Sample only: If a PDF printer isn't installed, try the Microsoft XPS Document
               // Writer.  Replace this with your printer name.
               var printers = applet.getPrinters().split(",");
               for (i in printers) {
		    if (printers[i].indexOf("Microsoft XPS") != -1 || 
			printers[i].indexOf("PDF") != -1) {
			   applet.setPrinter(i);      
		    }	       
               }
               
               // No suitable printer found, exit
               if (applet.getPrinter() == null) {
                   alert("Could not find a suitable printer for an HTML document");
                   return;
               }
               
               // Preserve formatting for white spaces, etc.
               var colA = fixHTML('<h2>*  jZebra HTML Printing  *</h2>');
               colA = colA + '<color=red>Version:</color> ' + applet.getVersion() + '<br />';
               colA = colA + '<color=red>Visit:</color> <http://code.google.com/p/jzebra';
               
               // HTML image
               var colB = '<img src="' + getPath() + 'img/image_sample.png">';
                
               // Append our image (only one image can be appended per print)
	       applet.appendHTML('<html><table face="monospace" border="1px"><tr height="6cm">' + 
	       	   '<td valign="top">' + colA + '</td>' + 
                   '<td valign="top">' + colB + '</td>' + 
                   '</tr></table></html>');
	    }

            // Very important for html, uses printHTML() instead of print()
            // *Note:  monitorAppending3() still works but is too complicated and
            // outdated.  Instead create a JavaScript  function called 
            // "jzebraDoneAppending()" and handle your next steps there.
	    monitorAppending3();
      }
      
      // Fixes some html formatting for printing. Only use on text, not on tags!  Very important!
      //    1.  HTML ignores white spaces, this fixes that
      //    2.  The right quotation mark breaks PostScript print formatting
      //    3.  The hyphen/dash autoflows and breaks formatting  
      function fixHTML(html) { return html.replace(/ /g, "&nbsp;").replace(/'/g, "'").replace(/-/g,"&#8209;"); }
      
      function printToFile() {
         var applet = document.jzebra;
         if (applet != null) {
            // Send characters/raw commands to applet using "append"
            // Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
            applet.append("A590,1600,2,3,1,1,N,\"jZebra " + applet.getVersion() + " sample.html\"\n");
            applet.append("A590,1570,2,3,1,1,N,\"Testing the print() function\"\n");
            applet.append("P1\n");
            
            // Send characters/raw commands to file
            // Ex:  applet.printToFile("\\\\server\\printer");
            // Ex:  applet.printToFile("/home/user/test.txt");
            applet.printToFile("C:\\jzebra_test.txt");
	 }
	 
         // *Note:  monitorPrinting() still works but is too complicated and
         // outdated.  Instead create a JavaScript  function called 
         // "jzebraDonePrinting()" and handle your next steps there.
	 monitorPrinting();
      }
      
      function chr(i) {
         return String.fromCharCode(i);
      }
      
      // *Note:  monitorPrinting() still works but is too complicated and
      // outdated.  Instead create a JavaScript  function called 
      // "jzebraDonePrinting()" and handle your next steps there.
      function monitorPrinting() {
	var applet = document.jzebra;
	if (applet != null) {
	   if (!applet.isDonePrinting()) {
	      window.setTimeout('monitorPrinting()', 100);
	   } else {
	      var e = applet.getException();
	      alert(e == null ? "Printed Successfully" : "Exception occured: " + e.getLocalizedMessage());
	   }
	} else {
            alert("Applet not loaded!");
        }
      }
      
      function monitorFinding() {
	var applet = document.jzebra;
	if (applet != null) {
	   if (!applet.isDoneFinding()) {
	      window.setTimeout('monitorFinding()', 100);
	   } else {
	      var printer = applet.getPrinter();
              alert(printer == null ? "Printer not found" : "Printer \"" + printer + "\" found");
	   }
	} else {
            alert("Applet not loaded!");
        }
      }

      function monitorFinding2() {
	var applet = document.jzebra;
	if (applet != null) {
	   if (!applet.isDoneFinding()) {
	      window.setTimeout('monitorFinding2()', 100);
	   } else {
              var printersCSV = applet.getPrinters();
              var printers = printersCSV.split(",");
              for (p in printers) {
                  alert(printers[p]);
              }
              
	   }
	} else {
            alert("Applet not loaded!");
        }
      }
      
      // *Note:  monitorAppending() still works but is too complicated and
      // outdated.  Instead create a JavaScript  function called 
      // "jzebraDoneAppending()" and handle your next steps there.
      function monitorAppending() {
	var applet = document.jzebra;
	if (applet != null) {
	   if (!applet.isDoneAppending()) {
	      window.setTimeout('monitorAppending()', 100);
	   } else {
	      applet.print(); // Don't print until all of the data has been appended
              
              // *Note:  monitorPrinting() still works but is too complicated and
              // outdated.  Instead create a JavaScript  function called 
              // "jzebraDonePrinting()" and handle your next steps there.
              monitorPrinting();
	   }
	} else {
            alert("Applet not loaded!");
        }
      }

      // *Note:  monitorAppending2() still works but is too complicated and
      // outdated.  Instead create a JavaScript  function called 
      // "jzebraDoneAppending()" and handle your next steps there.
      function monitorAppending2() {
	var applet = document.jzebra;
	if (applet != null) {
	   if (!applet.isDoneAppending()) {
	      window.setTimeout('monitorAppending2()', 100);
	   } else {
	      applet.printPS(); // Don't print until all of the image data has been appended
              
              // *Note:  monitorPrinting() still works but is too complicated and
              // outdated.  Instead create a JavaScript  function called 
              // "jzebraDonePrinting()" and handle your next steps there.
              monitorPrinting();
	   }
	} else {
            alert("Applet not loaded!");
        }
      }
      
      // *Note:  monitorAppending3() still works but is too complicated and
      // outdated.  Instead create a JavaScript  function called 
      // "jzebraDoneAppending()" and handle your next steps there.
      function monitorAppending3() {
	var applet = document.jzebra;
	if (applet != null) {
	   if (!applet.isDoneAppending()) {
	      window.setTimeout('monitorAppending3()', 100);
	   } else {
	      applet.printHTML(); // Don't print until all of the image data has been appended
              
              
              // *Note:  monitorPrinting() still works but is too complicated and
              // outdated.  Instead create a JavaScript  function called 
              // "jzebraDonePrinting()" and handle your next steps there.
              monitorPrinting();
	   }
	} else {
            alert("Applet not loaded!");
        }
      }
      
      function useDefaultPrinter() {
         var applet = document.jzebra;
         if (applet != null) {
            // Searches for default printer
            applet.findPrinter();
         }
         
         monitorFinding();
      }
      
      function jzebraReady() {
          // Change title to reflect version
          var applet = document.jzebra;
          var title = document.getElementById("title");
          if (applet != null) {
              title.innerHTML = title.innerHTML + " " + applet.getVersion();
              document.getElementById("content").style.background = "#F0F0F0";
          }
      }
      
      /**
       * By default, jZebra prevents multiple instances of the applet's main 
       * JavaScript listener thread to start up.  This can cause problems if
       * you have jZebra loaded on multiple pages at once. 
       * 
       * The downside to this is Internet Explorer has a tendency to initilize the
       * applet multiple times, so use this setting with care.
       */
      function allowMultiple() {
          var applet = document.jzebra;
          if (applet != null) {
              var multiple = applet.getAllowMultipleInstances();
              applet.allowMultipleInstances(!multiple);
              alert('Allowing of multiple applet instances set to "' + !multiple + '"');
          }
      }
      
      function printPage() {
           $("#content").html2canvas({ 
                canvas: hidden_screenshot,
                onrendered: function() {printBase64Image($("canvas")[0].toDataURL('image/png'));}
           });
      }
      
      function printBase64Image(base64data) {
         var applet = document.jzebra;
      	 if (applet != null) {
               applet.findPrinter("\\{dummy printer name for listing\\}");
               while (!applet.isDoneFinding()) {
                    // Note, endless while loops are bad practice.
               }

               var printers = applet.getPrinters().split(",");
               for (i in printers) {
		    if (printers[i].indexOf("Microsoft XPS") != -1 || 
			printers[i].indexOf("PDF") != -1) {
			   applet.setPrinter(i);      
		    }	       
               }
               
               // No suitable printer found, exit
               if (applet.getPrinter() == null) {
                   alert("Could not find a suitable printer for printing an image.");
                   return;
               }

               // Optional, set up custom page size.  These only work for PostScript printing.
               // setPaperSize() must be called before setAutoSize(), setOrientation(), etc.
               applet.setPaperSize("8.5in", "11.0in");  // US Letter
               applet.setAutoSize(true);
               applet.appendImage(base64data);
	    }

            // Very important for images, uses printPS() insetad of print()
            // *Note:  monitorAppending2() still works but is too complicated and
            // outdated.  Instead create a JavaScript  function called 
            // "jzebraDoneAppending()" and handle your next steps there.
	    monitorAppending2();
      }

      function logFeatures() {
          if (document.jzebra != null) {
              var applet = document.jzebra;
              var logging = applet.getLogPostScriptFeatures();
              applet.setLogPostScriptFeatures(!logging);
              alert('Logging of PostScript printer capabilities to console set to "' + !logging + '"');
          }
      }
   
      function useAlternatePrinting() {
          var applet = document.jzebra;
          if (applet != null) {
              var alternate = applet.isAlternatePrinting();
              applet.useAlternatePrinting(!alternate);
              alert('Alternate CUPS printing set to "' + !alternate + '"');
          }
      }

   </script>
<script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/jquery.plugin.html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/PluginDetect.js"></script>

</head>
<body  id="content" bgcolor="#FFF380">
<div id="printableArea">
       
</div>

<!--<input type="button" onclick="printDiv('printableArea')" value="Print Invoice" />


<A HREF="javascript:window.print()" onclick="printDiv('printableArea')">Click to Print This Page</A>-->


       
                        
                        
<?php 
   /* $printer = ("\\\\hostname\\printername"); 
    if($ph = printer_open($printer)) { 
       $fh = file_get_contents('myfile.txt');
       printer_set_option($ph, PRINTER_MODE, "RAW"); 
       printer_write($ph, $content); 
       printer_close($ph); 
    } else {
        echo "Can't connect to printer"; 
    }*/
?>   

<?php
# php printer
/*$handle = printer_open('EPSON TM-U220 Receipt');
    printer_set_option($handle, PRINTER_ORIENTATION, PRINTER_ORIENTATION_PORTRAIT );
printer_set_option($handle, PRINTER_PAPER_FORMAT, PRINTER_FORMAT_CUSTOM);
printer_set_option($handle, PRINTER_PAPER_LENGTH, 20);
printer_set_option($handle, PRINTER_PAPER_WIDTH, 70);
printer_set_option($handle, PRINTER_MODE, "RAW");

    while($flagQty < $goodsQty){

    printer_start_doc($handle, "marker");
    printer_start_page($handle);
        printer_draw_text($handle, "marker name", 0, 0);
        printer_end_page($handle);
    printer_end_doc($handle);
    }

    printer_close($handle);*/
?>

jzebra


test detect

<input type=button onClick="findPrinter()" value="Detect Printer"><br />
   <input type=button onClick="findPrinters()" value="List All Printers"><br />
   <input type=button onClick="useDefaultPrinter()" value="Use Default Printer"><br /><br />
   <applet name="jzebra" code="jzebra.PrintApplet.class" archive="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/jzebra.jar" width="50px" height="50px">
      <!-- Optional, searches for printer with "zebra" in the name on load -->
      <!-- Note:  It is recommended to use applet.findPrinter() instead for ajax heavy applications -->
      <param name="printer" value="zebra">
      <!-- ALL OF THE CACHE OPTIONS HAVE BEEN REMOVED DUE TO A BUG WITH JAVA 7 UPDATE 25 -->
	  <!-- Optional, these "cache_" params enable faster loading "caching" of the applet -->
      <!-- <param name="cache_option" value="plugin"> -->
      <!-- Change "cache_archive" to point to relative URL of jzebra.jar -->
      <!-- <param name="cache_archive" value="./jzebra.jar"> -->
      <!-- Change "cache_version" to reflect current jZebra version -->
      <!-- <param name="cache_version" value="1.4.9.1"> -->
   </applet><br />
   
test detect


<input type=button onClick="print()" value="Print">
<applet name="jzebra" code="jzebra.PrintApplet.class" archive="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/jzebra.jar" width="100" height="100">
      <param name="printer" value="zebra">
</applet>
<?php foreach($query_data as $row): ?>
       <?php $wo_no = $row->wo_no; ?>
       <?php endforeach; ?>
       
       
<script>
      function print() {
       document.jZebra.append("<?php echo $wo_no; ?>\n");
       document.jZebra.print();
      }
</script>                  

document.jZebra.append(<?php echo $wo_no; ?>);

<?php echo $wo_no; ?>


<input type=button onClick="findPrinter()" value="Detect Printer"><br />
   <input type=button onClick="findPrinters()" value="List All Printers"><br />
   <input type=button onClick="useDefaultPrinter()" value="Use Default Printer"><br /><br />
   <applet name="jzebra" code="jzebra.PrintApplet.class" archive="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/jzebra.jar" width="50px" height="50px">
      <!-- Optional, searches for printer with "zebra" in the name on load -->
      <!-- Note:  It is recommended to use applet.findPrinter() instead for ajax heavy applications -->
      <param name="printer" value="zebra">
      <!-- ALL OF THE CACHE OPTIONS HAVE BEEN REMOVED DUE TO A BUG WITH JAVA 7 UPDATE 25 -->
	  <!-- Optional, these "cache_" params enable faster loading "caching" of the applet -->
      <!-- <param name="cache_option" value="plugin"> -->
      <!-- Change "cache_archive" to point to relative URL of jzebra.jar -->
      <!-- <param name="cache_archive" value="./jzebra.jar"> -->
      <!-- Change "cache_version" to reflect current jZebra version -->
      <!-- <param name="cache_version" value="1.4.9.1"> -->
   </applet><br />

</body>    
</html>       