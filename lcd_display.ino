int DigitPins[] = {2, 3, 4, 5};
int SegmentPins[] = {6, 7, 8, 9, 10, 11, 12, 13};

String lcdCharacters[63] = {"0","1","2","3","4","5","6","7","8","9",
						"A","B","C","D","E","F","G","H","I","J","K",
						"L","M","N","O","P","Q","R","S","T","U","V",
						"W","X","Y","Z","a","b","c","d","e","f","g",
						"h","i","j","k","l","m","n","o","p","q","r",
						"s","t","u","v","w","x","y","z", ""};
int characterCodes[63] = {192,249,164,176,153,146,130,248,128,144,136,
						128,198,192,134,142,194,137,249,225,137,199,171,
						171,192,140,144,136,146,135,193,193,227,137,145,
						164,136,131,167,161,134,142,194,139,249,225,137,
						199,171,171,163,140,144,206,146,135,227,227,227,
						137,145,164,255};



void setup() {
  //Setting lcd pins as OUTPUT
  for (byte digit=0;digit<4;digit++) {
    pinMode(DigitPins[digit], OUTPUT);
  }
  for (byte seg=0;seg<8;seg++) {
    pinMode(SegmentPins[seg], OUTPUT);
  }
}

void loop() {

	lcdDisplayText("test");

}


void lcdDisplayText(String text) { //Displays a 4 character message

	char textChar[4];
	text.toCharArray(textChar,5);
	
	int convertedChar[4];
	for(byte i=0;i<4;i++){
		convertedChar[i] = findCharacterCode(textChar[i]);
	}

	lcdDisplayMulti(convertedChar);

}


int findCharacterCode(char character) { //returns the code of the given character
	int index = 62;
	int i=0;
	bool found = false;

	while(found==false && i<=62) {
		if(character == lcdCharacters[i].charAt(0)) {
			index = i;
			found = true;
		}
		i++;
	}

	return characterCodes[index];

}

void lcdDisplayMulti(int numbers[]) { //Displays 4 characters on the lcd
 
 int defaultSpeed = 2; //Screen speed in ms 
 
 for(byte i=0;i<4;i++) {
  lcdClear();
  lcdDisplay(numbers[i],i);
  delay(defaultSpeed);   
 }
  
}

void lcdDisplay(int number, int pos) { //Displays 1 charater on the lcd, on the selected digit
  
  digitalWrite(DigitPins[pos], HIGH); 
  
  for(byte i=0;i<8;i++) {
   bool bitValue = bitRead(number,i);
   digitalWrite(SegmentPins[i], bitValue);
  }
}

void lcdClear() { //Clears the lcd screen
  
  for(byte i=0;i<4;i++) {
   digitalWrite(DigitPins[i], LOW); 
  }
  for(byte i=0;i<8;i++) {
   digitalWrite(SegmentPins[i], HIGH);    
  }
  
}
