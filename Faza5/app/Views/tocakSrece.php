<!--Lana Ivković-->


<section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= base_url("lana/css/spin.css")?>">
    <form action="<?= base_url("KorisnikController/tocakSrece")?>" method="POST" id="myForm">
    <input type="submit"  id="spin_dugme"  value="Preuzmi nagradu">
    <button type="submit" id="spin">Spin </button>

	
    
	<span class="arrow"></span>
<div class="row">
    <div class="container col-xl-8 col-lg-8 col-md-8 col-sm-12">
        <div class="one" > <span id="one" >20%</span></div> 
        <div class="eight" > <span id="eight">1000din</span></div>
        <div class="seven" > <span id="seven">2000din</span></div>
        <div class="six" ><span id="six">10%</span></div>
        <div class="five" ><span id="five">5%</span></div>
        <div class="four"><span id="four">nista</span></div>
        <div class="three" ><span id="three">1500din</span></div>
        <div class="two" > <span id="two">8%</span></div>
    </div>
    
    
<div class="justify-content-center" style="margin: auto; width: 50%;" ;>
<label style="font-weight: bold; font-family: Georgia, 'Times New Roman', Times, serif;" >Rezultat: </label>
<div class="polje justify-content-center" > <input name="poklon" id="dobitak" value="20%" readonly ></div>
<label style="font-weight: bold; font-family: Georgia, 'Times New Roman', Times, serif;" >Preostalo: </label>
<div class="polje justify-content-center" > <span id="tokeni"><?=$tokena?> </span></div>


</div>

</form>

<script src="<?= base_url("lana/js/spininjs.js")?>"></script>


</section>
