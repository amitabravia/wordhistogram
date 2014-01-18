wordhistogram
=============

Self growing database, where someone can keep track of the words most searched.
Nearly needs nothing to be installed. Just put this inside in a folder in your htdocs folders
or where you generally put your local php-mysql projects. 
Uses sqlite3 database. 
Written in php 5.5
ParseWords.php is used to break a sentence into possible words.
SearchWords.php is used to sort by most searched, matching frequency( with a tolerance of +- 2) and Stems.
Stemmer.php is used to find the stem of a word. The Porter's Algorithm has been adopted.
SearchText.php is used to search the text, get words you might be intersted in or the words having similar
stems.
I didnot do two things.
1)I didnot display anything when user preses Search,but, increased the count of the word.
  It is the users choice what to do with it.
2)Because i didnot have any text or dat file of the englisg dictionary, the Synonyms are
  shown are localised and limited by the words in the database.

Some errors may exist, need feedback if found.
