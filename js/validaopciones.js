// JavaScript Document

function valida1opcion(){
var checkBox = document.getElementsByName ("val_option[]");
var checkBox1 = document.getElementById("masinfoADR1_0");
for (var i=0; i < checkBox.length; i++){
  if (checkBox1.checked == true) {
     checkBox[i].checked=true;
}
 }
}
function valida2opcion(){
var checkBox = document.getElementsByName ("val_option[]");
var checkBox2 = document.getElementById("masinfoADR1_1");
for (var i=0; i < checkBox.length; i++){
  if (checkBox2.checked == true) {
     checkBox[i].checked=true;
}
 }
}
function valida3opcion(){
var checkBox = document.getElementsByName ("val_option[]");
var checkBox3 = document.getElementById("masinfoADR1_2");
for (var i=0; i < checkBox.length; i++){
  if (checkBox3.checked == true) {
     checkBox[i].checked=true;
}
 }
}

function valida1opcioncamion21(){
var checkBox = document.getElementsByName ("val_optioncamion21[]");
var checkBox1 = document.getElementById("masinfocamion21_0");
for (var i=0; i < checkBox.length; i++){
  if (checkBox1.checked == true) {
     checkBox[i].checked=true;
}
 }
}
function valida2opcioncamion21(){
var checkBox = document.getElementsByName ("val_optioncamion21[]");
var checkBox2 = document.getElementById("masinfocamion21_1");
for (var i=0; i < checkBox.length; i++){
  if (checkBox2.checked == true) {
     checkBox[i].checked=true;
}
 }
}
function valida3opcioncamion21(){
var checkBox = document.getElementsByName ("val_optioncamion21[]");
var checkBox3 = document.getElementById("masinfocamion21_2");
for (var i=0; i < checkBox.length; i++){
  if (checkBox3.checked == true) {
     checkBox[i].checked=true;
}
 }
}