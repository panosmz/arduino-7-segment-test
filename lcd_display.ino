int DigitPins[] = {2, 3, 4, 5};
int SegmentPins[] = {6, 7, 8, 9, 10, 11, 12, 13};


void setup() {
  for (byte digit=0;digit<4;digit++) {
    pinMode(DigitPins[digit], OUTPUT);
  }
  for (byte seg=0;seg<8;seg++) {
    pinMode(SegmentPins[seg], OUTPUT);
  }

}

void loop() {


}





void lcdDisplayMulti(int numbers[]) {
 
 int defaultSpeed = 2; //Screen speed in ms 
 
 for(byte i=0;i<4;i++) {
  lcdClear();
  lcdDisplay(numbers[i],i);
  delay(defaultSpeed);   
 }
  
}

void lcdDisplay(int number, int pos) {
  
  digitalWrite(DigitPins[pos], HIGH); 
  
  for(byte i=0;i<8;i++) {
   bool bitValue = bitRead(number,i);
   digitalWrite(SegmentPins[i], bitValue);
  }
}

void lcdClear() {
  
  for(byte i=0;i<4;i++) {
   digitalWrite(DigitPins[i], LOW); 
  }
  for(byte i=0;i<8;i++) {
   digitalWrite(SegmentPins[i], HIGH);    
  }
  
}
