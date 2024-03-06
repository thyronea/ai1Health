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
  #printSection, #printSection * {
      visibility:visible;
  }
  #printSection {
      position:absolute;
      left:0;
      top:0;
  }
}
</style>
