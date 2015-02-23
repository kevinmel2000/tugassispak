<style>
    a.test {
        font-weight: bold;
    }
</style>

<script type="text/javascript">

    // selector to document
    $(document).ready(function(){
        // selector tag a
        $("a").click(function(event){
            event.preventDefault();
        });
        
        // add class to element
        $("button#id_bold").click(function(event){
            event.preventDefault();
            
            $(this).hide("slow");
            
            $("a").addClass("test");
        });
        
        // remove class from element
        $("button#normal").click(function(event){
            $("a").removeClass("test");
        });
        
        // remove class from element
        $("button#normal").click(function(event){
            $("a").removeClass("test");
        });
        
        function showA()
        {
            alert("showA");
            console.log("This is log from showA button.");
        }
        
         // call another function
        $("button#showA").click(function(event){
            showA();
        });
    });
    
    function showA()
    {
        return 1;
    }
    //var b = showA();
    //console.log(a);
    
    // data type
    
    var mString = 'this is string';
    var mUndefined;
    var mNull = null;
    var mNumber = 0.33;
    
    //alert(mString);
    //if(mUndefined === undefined) alert("undefined");
    //if(mNull === null) alert("null");
    //alert(mNumber);
    
    // object
    
    var mPerson = new Object;
    mPerson.name = "anjar";
    mPerson.address = "cipanas";
    mPerson["pacar"] = "resti";
    
    //alert(mPerson.name + " " + mPerson.address + " " + mPerson.pacar);
    
    
    var mArr = new Array();
    mArr[0] = 1;
    mArr.push(2);
    
    console.log("Length " + mArr.length);
    console.log("Element " + mArr[0]);
    console.log("Element " + mArr[1]);
    
    console.log("Is array " + jQuery.isArray(mArr));
    console.log(typeof mArr);
    console.log(typeof mPerson.name);
    
    // Values that evaluate to true:
    //"0";
    //"any string";
    //[]; // An empty array.
    //{}; // An empty object.
    //1; // Any non-zero number.
    
    
    //// Values that evaluate to false:
    //""; // An empty string.
    //NaN; // JavaScript's "not-a-number" variable.
    //null;
    //undefined; // Be careful -- undefined can be redefined!
    //0; // The number zero.
    
    for(var x=0;x<10;x++)
    {
        console.log("try + " + x);
    }
    
    // array
    var mAr = [1, 2, 3, 4, 5];
    console.log(mAr.join(" "));
    mAr.pop();
    console.log(mAr.join(" "));
    
    mAr.unshift(0);
    console.log(mAr.join(" "));
    
    var my = function myFunc(param1, param2)
    {
        console.log(param1 + " " + param2);
    }
    
    my("aqua", "galon");
    
</script>

<script type="text/javascript">
    
    $(function()
    {
        console.log("ready");
    });
    
    // mengatasi konflik dengan lib lain
    //var $j = jQuery.noConflict();
    
    //attribut attr();
    //setter getter
    
    $(document).ready(function(){
        console.log("ready");
        
        var a = $("a#aId").attr("href");
        console.log(a);
        $("a#aId").attr("href","edited");
        var a = $("a#aId").attr("href");
        console.log(a);
        $("a#aId").attr({
            href : "aqua",
            id : "edited"});
        var a = $("a#edited").attr("href");
        console.log(a);
        
        // selector
        
        var s = $("input#idText").attr("type");
        console.log("selector " + s);
        
        var s = $("div.myClass").has("p");
        console.log("div element div : " + s.length);
        
        var s = $("h1").not(".hClass");
        console.log("div element h1: " + s.length);
    }); 
    
    
   
</script>



<div id="myId">
    <div class="myClass">
        <a href="localhost" target="_blank" id="aId" >Click me</a>
        <button name="bold" id="id_bold">Bold</button>
        <button name="normal" id="normal" >Normal</button>
        <button name="normal" id="showA" >ShowA</button>
        <input type="text" id="idText" />
        <p>as</p>
        <h1 class="hClass">
            <p>title</p></h1>
    </div>
</div>