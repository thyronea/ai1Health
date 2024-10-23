<style>
  @keyframes gradient {
  0% {
      background-position: 0% 50%;
  }
  50% {
      background-position: 100% 50%;
  }
  100% {
      background-position: 0% 50%;
  }
}

.nav-item {
  padding-left: 25px;
  text-decoration: none;
  color: black;
  font-size: 14px;
}

.nav-item:hover {
  color: #27bcda;
}

.btn {
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    color: #fff;
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

.btn:hover {
  color: #fff;
}

body {
   min-height: 400px;
   margin-bottom: 100px;
   clear: both;
}

footer {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #111;
  height: auto;
  width: 100%;
  color: #fff;
}

.footer-content {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  text-align: center;
}

.footer-content h3{
  padding-left: 25px;
  font-weight: 500;
  line-height: 3rem;
}

.footer-bottom a:hover {
  color: #27bcda;
}

.footer-bottom p {
  float: left;
   font-size: 14px;
   word-spacing: 2px;
   color: #cfd2d6;
}
.footer-bottom p a{
  font-size: 14px;
  color: #cfd2d6;
  text-decoration: none;
}
.footer-bottom span{
    text-transform: uppercase;
    opacity: .4;
    font-weight: 200;
}

.footer-menu{
  float: right;
  padding-right: 80px;
}

.footer-menu ul{
  display: flex;
}

.footer-menu ul li{
padding-right: 10px;
display: block;
}

.footer-menu ul li a{
  color: #cfd2d6;
  text-decoration: none;
  font-size: 14px;
}

.footer-menu ul li a:hover{
  color: #27bcda;
}

#systems:hover{
  background-color: #c2defc;
  transition: all 3s ease;
}

</style>