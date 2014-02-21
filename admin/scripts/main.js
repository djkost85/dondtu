function htmlspecialchars_decode(string, quote_style) {
  var optTemp = 0, i = 0, noquotes = false;
  if (typeof quote_style === 'undefined')
    quote_style = 2;
  string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  };
  if (quote_style === 0)
    noquotes = true;
  if (typeof quote_style !== 'number') {
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      if (OPTS[quote_style[i]] === 0)
        noquotes = true;
      else if (OPTS[quote_style[i]])
        optTemp = optTemp | OPTS[quote_style[i]];
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE)
    string = string.replace(/&#0*39;/g, "'");
  if (!noquotes)
    string = string.replace(/&quot;/g, '"');
  string = string.replace(/&amp;/g, '&');
  return string;
}