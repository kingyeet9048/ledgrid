OPC opc;
String[] recieved = new String[3];
Server server;
//what happans when the program first starts...like the start function in unity. 
void setup()
{
  
   try {
      //ServerSocket Setup
      server = new Server();
      server.start();
      recieved = server.messages;
   }
   catch(Exception e) {
     println(e);
   }
  //size of the window
  size(600, 300);
  
  
  //creates a new connection in the for of an object to the fadecandy devices. 
  //also connects to the local host. 
  opc = new OPC(this, "199.17.162.75", 7890);
  
  //spacing between each led on the window. 
  float spacing = height / 160;
  
  //0 is the starting led. 60 is the length of each strip. 
  //width/2 and height/2 besically gets the center of the led grid. 
  //angle if the grid is tilted. zigzag should be false since our strips do not zigzag.
  opc.ledGrid(0, 60, 80, width/2, height/2, spacing, spacing, 0, false, false);
  
  //new font with the size of the font. 
  PFont f = createFont("Tinos", 15);
  //sets the font for the text. 
  textFont(f);
  
}

String scrollMessage(String text, float speed, int panel) 
{
  int ypos;
  if(panel == 1) {
    //top of the window with a bit of offset. 
    ypos = (height/2) - 20;
  }
  else if(panel == 2) {
    //middle of the window with a bit of offset. 
    ypos = (height/2) + 6;
  }
  else if(panel == 3) {
     //bottom of the window with a bit of offset. 
    ypos = (height/2) + 40; 
  }
  else {
    //top of the window with a bit of offset. 
    ypos = (height/2)  -20; 
  }
  
    
  //math to get the xpos given how fast. 
  int xpos = int( (millis() * -speed) % (textWidth(text) + width/2 + 32) );
  //actually displays the text with a given x and y position. 
  color(255,0,0);
  text(text, xpos, ypos);
  return null;
}
  
//void draw constantly draws...like the update funtion in unity. 
void draw()
{
  background(0);
  scale(-1.0, 1.0);
  
  //calling the scrollMessage fucntion to display the text acroll the window every
  //frame.
   stroke(255);
   recieved = server.messages;
   String hello = (recieved[0] != null) ? scrollMessage(recieved[0], 0.04, 1) : scrollMessage("Please wait....", 0.04, 1);
   hello = recieved[1] != null ? scrollMessage(recieved[1], 0.04, 2) : scrollMessage("Please wait...", 0.04, 2);
   hello = recieved[2] != null ? scrollMessage(recieved[2], 0.04, 3) : scrollMessage("Please wait...", 0.04, 3);
}
void dispose() {
  
}
