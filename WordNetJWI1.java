package WordNetJWI ;

import edu.mit.jwi.*;
import edu.mit.jwi.item.*;
import java.net.*;
import java.util.Iterator;
import java.util.List;
import java.io.IOException;

/**
 *
 * @author Jenifer
 */
public class WordNetJWI1 {

    
    public static boolean getHypernyms(String ss)throws IOException 
	{
       try
        {
                     
		//  using jwi in wordnet 2.1
           String path = "C:\\Program Files (x86)\\WordNet\\2.1\\dict";
		   System.out.println(path);
            URL url = new URL("file", null, path);
    
		// construct the dictionary object and open it
            IDictionary dict = new Dictionary(url);
            dict.open();
		// get the synset
            IIndexWord idxWord = dict.getIndexWord(ss, POS.NOUN);
			if(!(idxWord instanceof IIndexWord))
			{
			    idxWord = dict.getIndexWord(ss, POS.VERB);
                if(!(idxWord instanceof IIndexWord))
			   {
			       idxWord = dict.getIndexWord(ss, POS.ADJECTIVE);
                   if(!(idxWord instanceof IIndexWord))
			      {
			          idxWord = dict.getIndexWord(ss, POS.ADVERB);
                      return false;
			      }
			  }
			}
    }
	catch(Exception e)
    {
        System.out.println("Exception" + e);
    } 
	return true;
    }
}
 