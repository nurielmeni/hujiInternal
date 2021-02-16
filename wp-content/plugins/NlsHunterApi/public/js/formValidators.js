function validateISRID(str)
{ 
    // DEFINE RETURN VALUES
    var R_ELEGAL_INPUT = -1;
    var R_NOT_VALID = -2;
    var R_VALID = 1; 
    
   //INPUT VALIDATION

   // Just in case -> convert to string
   var IDnum = String(str);

   // Validate correct input (Changed from 5 to 9 so only 9 digits are allowed)
   if ((IDnum.length > 9) || (IDnum.length < 9))
      return R_ELEGAL_INPUT; 
   if (isNaN(IDnum))
      return R_ELEGAL_INPUT;

   // The number is too short - add leading 0000
   if (IDnum.length < 9)
   {
      while(IDnum.length < 9)
      {
         IDnum = '0' + IDnum;         
      }
   }

   // CHECK THE ID NUMBER
   var mone = 0, incNum;
   for (var i=0; i < 9; i++)
   {
      incNum = Number(IDnum.charAt(i));
      incNum *= (i%2)+1;
      if (incNum > 9)
         incNum -= 9;
      mone += incNum;
   }
   if (mone%10 == 0)
      return R_VALID;
   else
      return R_NOT_VALID;
}

function validateFullname(str) {
    if (str.length < 2) {
        return false;
    } else {
        return true;
    }
}