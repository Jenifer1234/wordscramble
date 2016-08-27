import java.awt.Container;
import java.awt.FlowLayout;
import java.awt.Font;
import java.awt.Toolkit;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.io.IOException;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.awt.EventQueue; 
import javax.swing.AbstractAction;
import javax.swing.Action;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JTextArea;
import javax.swing.JTextField;
import javax.swing.KeyStroke;
 
/* 
 * @author Jenifer A
 *
 */

class WordScrambleImpl extends JFrame
 {	
	public JTextField dataField;
	public JButton submitButton;
	public JButton startButton;	
    public JPanel mainPanel;
    public Action enterAction;
    public ButtonListener buttonListener;    
	public JTextArea ta;
	public String word ="";
	public JLabel timeLabel,sw,l1;
	public int startCount = 50;
	public Timer countDownTimer;
	public String scramleWord="";	
	public static String[] words;
	public static int i = 0;
	public static int score = 0;	
	public int j;
	public WordScrambleImpl()
	{	    
		mainPanel = new JPanel();
		buttonListener = new ButtonListener();
		dataField = new JTextField( 20 );
		submitButton = new JButton( "Submit" );
		startButton = new JButton( "Start" );				
		l1 = new JLabel("WORD SCRAMBLE");
	}
	
	public void playGame() throws FileNotFoundException
	{		
	    super("Word Scramble");
		super.setSize(1500, 1500);
		super.setDefaultCloseOperation(EXIT_ON_CLOSE);
		super.setResizable(false);
		Container c = super.getContentPane();
		c.setLayout(new FlowLayout());
		c.setBackground(Color.CYAN);
		Font font = new Font("RockWell Extra Bold", Font.PLAIN,100);
		Font font1= new Font("Rockwell", Font.PLAIN,155);		
		ReadScramleWord rsw = new ReadScramleWord();
		scramleWord=rsw.getScramleWord();
		sw = new JLabel(scramleWord);
		sw.setVisible(false);		
		sw.setFont(font);		
		ta =new JTextArea("\t\tINSTRUCTIONS\n1. Use the letters that appear in the window and try to generate as many words as possible.\n2.Don't use any letters other than the given letters\n3.Frame only nouns,adjectives,adverbs and Verbs.\n4.Plurals,various tense forms for the already given words are not allowed\n5.You will score 500 for each right answer\n6.It must be atleast 3 character(important)\n7.Try to find atleast 8 words to win the game",7, 30);
		ta.setFont(new Font("Rockwell",Font.ITALIC,30));
		ta.setForeground(Color.GREEN);
		ta.setBackground(Color.BLACK);
		timeLabel = new JLabel(String.valueOf(startCount), JLabel.CENTER);
		countDownTimer = new Timer(1000, new CountdownTimerListener());
		timeLabel.setFont(font);				
		l1.setFont(font1);				
		datafield.setEditable(false);
		ta.setEditable(false);
		c.add(l1);
		c.add(startButton);		
		c.add(datafield);
		c.add(submitButton);
		c.add(ta);   
		c.add(sw); 
		c.add(timeLabel);
		startButton.addActionListener(new ActionListener()
		{
			public void actionPerformed(ActionEvent ae)
			{			    
				countDownTimer.start();
				sw.setVisible(true);
				dataField.setEditable(true);
				dataField.requestFocus();
			}
		});
		dataField.addKeyListener(new KeyListener()
		{    
			public void keyPressed(KeyEvent e)
			{
				String ch =  (String)(e.getKeyChar());
				CharSequence cs = (CharSequence)ch;
				if (!scramleWord.contains(cs))							
					Toolkit.getDefaultToolkit().beep();					
			}
		});
		submitButton.addActionListener(buttonListener);
		enterAction = new EnterAction();
		dataField.getInputMap().put( KeyStroke.getKeyStroke( "ENTER" ),
                "doEnterAction" );
		dataField.getActionMap().put( "doEnterAction", enterAction );
	}
static class EnterAction extends AbstractAction
{
	public void actionPerformed( ActionEvent ae )
	{
           submitButton.doClick();
	}  
}	


// Actual action performed when the player types in a word and presses enterkey.

static class ButtonListener implements ActionListener
{
	public void actionPerformed( ActionEvent bp )
	{        
		dataField.requestFocusInWindow();
		dataField.selectAll();                      
		try
		{	                                                			
			String str = dataField.getText();	                        
			if(str.length() < 3)					
			    JOptionPane.showMessageDialog(null,"You have typed word of less than 3 characters", 
"Word Scramble", 1);                     												
			else
			{
			    if(i > 0)
			    {							    
				   for(j= 0; j < i; j++)
				   {
			     	    if(words[j].equals(str))
						{
						    score-=500;
						    JOptionPane.showMessageDialog(null,"You have given the word already :"+score, 									
"Word Scramble", 1);				                                                                      
                            break;
                        }
                    }
					   if(j == i)
					   {
							if(WordNetJWI1.getHypernyms(str))
							{
								score += 500;
								JOptionPane.showMessageDialog(null,"You are correct\n Score :"+score, 
"Word Scramble", 1);
								words[i++] = str;							
							}
							else
								JOptionPane.showMessageDialog(null,"You are wrong", "Word Scramble", 1);
					    }     
					}                           									                               							 
                    else
					{	
					    if(WordNetJWI1.getHypernyms(str))
					    {
							score += 500;
						    JOptionPane.showMessageDialog(null,"You are correct\n Score :"+score, 
"Word Scramble", 1);
							words[i++] = str;							
						}
						else
						   JOptionPane.showMessageDialog(null,"You are wrong", "Word Scramble", 1);
     			    }                           						
				}			
				dataField.setText("");
				dataField.requestFocus();
			}		
			catch(IOException ie)
			{
				//System.out.println(ie);
			}
	}
}

// Timer class. 

// This class is used to run timer for the player to find as many meaningful words as possible 
static	class CountdownTimerListener implements ActionListener 
	{
		public void actionPerformed(ActionEvent e)
		{
         sw.setFocusable(true);
		 if (--startCount > 0) {
            timeLabel.setText(String.valueOf(startCount));
         } else {
            timeLabel.setText("OOPS!!Time's up!");
            countDownTimer.stop();
			tf.setEditable(false);
			submitButton.setEnabled(false);
			if(WordScrambleImpl.score >= 4000)
			   JOptionPane.showMessageDialog(null,"Congratulations !! You own the game\n Final Score :"+WordScrambleImpl.score, 
"Word Scramble", 1);
			else
			 JOptionPane.showMessageDialog(null,"Sorry!!!You missed a chocolate\n Final Score :"+WordScrambleImpl.score, 
"Word Scramble", 1);
         }
      }
   }
 }