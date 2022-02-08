<?php
require_once('includes/load.php');
require_once('includes/functions.php');
require('pdf/fpdf.php');
// Extension de la clase

class PDF extends FPDF
{

protected $ProcessingTable=false;
protected $aCols=array();
protected $TableX;
protected $HeaderColor;
protected $RowColors;
protected $ColorIndex;

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $pagina=impresion('Página');
    $this->Cell(0,10,$pagina." ".$this->PageNo().'/{nb}',0,0,'C');
}

function Header()
{
    // Print the table header if necessary
    //if($this->ProcessingTable)
    {
        $this->TableHeader();
  
      $this->Image('libs/images/logo_adadi.png',10,10,25,25);
      $this->Cell(80);
    // Título
  $encabezado=impresion('Gestión de Incidencias TIC: Listado de Usuarios');
    $this->Cell(30,10,$encabezado,0,0,'C');
    // Salto de línea
    $this->Ln(20);
  }
}

function TableHeader()
{
    $this->SetFont('Arial','B',12);
    $this->SetX($this->TableX);
    $fill=!empty($this->HeaderColor);
    if($fill)
        $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
    foreach($this->aCols as $col)
        $this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
    $this->Ln();
}

function Row($data)
{
    $this->SetX($this->TableX);
    $ci=$this->ColorIndex;
    $fill=!empty($this->RowColors[$ci]);
    if($fill)
        $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
    foreach($this->aCols as $col)
       // $this->Cell($col['w'],5,$data[$col['f']],1,0,$col['a'],$fill);
       $this->Cell($col['w'],5,$data[$col['f']],1,0,'L',$fill);
    $this->Ln();
    $this->ColorIndex=1-$ci;
}

function CalcWidths($width, $align)
{
    // Compute the widths of the columns
    $TableWidth=0;
    foreach($this->aCols as $i=>$col)
    {
        $w=$col['w'];
        if($w==-1)
            $w=$width/count($this->aCols);
        elseif(substr($w,-1)=='%')
            $w=$w/100*$width;
        $this->aCols[$i]['w']=$w;
        $TableWidth+=$w;
    }
    // Compute the abscissa of the table
    if($align=='C')
        $this->TableX=max(($this->w-$TableWidth)/2,0);
    elseif($align=='R')
        $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
    else
        $this->TableX=$this->lMargin;
}

function AddCol($field=-1, $width=-1, $caption='', $align='L')
{
    // Add a column to the table
    if($field==-1)
        $field=count($this->aCols);
    $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
}

function Table($query,$prop=array())
{
    
    // Handle properties
    if(!isset($prop['width']))
        $prop['width']=0;
    if($prop['width']==0)
        $prop['width']=$this->w-$this->lMargin-$this->rMargin;
    if(!isset($prop['align']))
        $prop['align']='C';
    if(!isset($prop['padding']))
        $prop['padding']=$this->cMargin;
    $cMargin=$this->cMargin;
    $this->cMargin=$prop['padding'];
    if(!isset($prop['HeaderColor']))
        $prop['HeaderColor']=array();
    $this->HeaderColor=$prop['HeaderColor'];
    if(!isset($prop['color1']))
        $prop['color1']=array();
    if(!isset($prop['color2']))
        $prop['color2']=array();
    $this->RowColors=array($prop['color1'],$prop['color2']);
    // Compute column widths
    $this->CalcWidths($prop['width'],$prop['align']);
    // Print header
    $this->TableHeader();
   
    // Print rows

            $this->SetFont('Arial','',11);
            $this->ColorIndex=0;
            $this->ProcessingTable=true;

            // Execute query
            $res=find_by_sql($query);
            foreach($res as $row)
                $this->Row($row);
            $this->ProcessingTable=false;
            $this->cMargin=$cMargin;
            $this->aCols=array();
}
}
//----------------------------------
$pdf = new PDF('L','mm','A4');


$pdf->AddPage();
// Second table: specify 3 columns
$nombre = impresion('NOMBRE');
$usuario = impresion('USUARIO');
$correo = impresion('CORREO ELECTRÓNICO');
$pdf->AliasNbPages();
$pdf->AddCol('nombre','30%',$nombre,'C');
$pdf->AddCol('usuario','20%',$usuario,'C');
$pdf->AddCol('correo','30%',$correo,'C');
$prop = array('HeaderColor'=>array(214, 234, 248),
            'color1'=>array(232, 239, 244),
            'color2'=>array(249, 251, 252),
            'padding'=>2);

$pdf->Table('select nombre,usuario,correo from usuarios where nivel=1 order by nombre',$prop);


$pdf->Output('D','ADADI_Listado_Usuarios.pdf',true);
?>
 