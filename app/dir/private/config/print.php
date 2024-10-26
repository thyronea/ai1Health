<!-- CSS to hide background when window.print() is called -->
<style>
@media screen {
  #printSection {
      display: none;
  }
}
@media print {
  body * {
    visibility:hidden;
  }
  html, body {
    height:100vh; 
    overflow: hidden;
  }
  @page {
    size: portrait;
  }
  #printSection, #printSection * {
      visibility:visible;
  }
  #printSection {
      position:absolute;
      left:0;
      top:0;
      width: 100%;
  }
}
</style>
