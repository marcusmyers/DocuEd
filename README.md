# DocuEd

Is a start to a Document Management software to digitize records for retention.


Below is the initial README and is not totally outdated.  Need to clean this process up

Install Ubuntu Server (Select LAMP, OpenSSH Server on install)

run install.sh

To split a file with pdftk

pdftk in.pdf burst 
	OPTIONALLY
		pdftk in.pdf burst output newname_%02d.pdf 

Use Ghostscript to convert PDF to TIFF

gs -dNOPAUSE -sDEVICE=tiffg4 -r600x600 -dBATCH -sPAPERSIZE=letter -sOutputFile=Output_File_Name.tif Name_of_PDF.pdf

Use Tesseract to ocr TIFF

tesseract in-file.tif outfile -l eng
