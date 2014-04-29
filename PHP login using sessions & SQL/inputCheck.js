function testKey(e)
{
 
  var key = (typeof e.charCode === 'undefined' ? e.keyCode : e.charCode);


  if (e.ctrlKey || e.altKey || key < 32)
    return true;

  key = String.fromCharCode(key);
  return /\w/.test(key);
}

