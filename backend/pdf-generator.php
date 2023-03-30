<?php
require('./fpdf/fpdf.php');

// // Créer un objet FPDF
// $pdf = new FPDF();

// // Ajouter une page
// $pdf->AddPage();

// // Définir la police et la taille de police pour le titre
// $pdf->SetFont('Arial', 'B', 24);

// // Ajouter un titre centré
// $pdf->SetFillColor(65, 132, 228); // Couleur de fond
// $pdf->SetTextColor(255, 255, 255); // Couleur de texte
// $pdf->Cell(0, 30, 'Informations utilisateur', 0, 1, 'C', true);

// // Définir la police et la taille de police pour les étiquettes et les données
// $pdf->SetFont('Arial', '', 12);

// // Ajouter de l'espace entre le titre et le tableau
// $pdf->Ln(10);

// // Ajouter des étiquettes et des données
// $pdf->SetFillColor(238, 242, 246); // Couleur de fond pour les étiquettes
// $pdf->SetTextColor(65, 132, 228); // Couleur de texte pour les étiquettes
// $pdf->Cell(40, 10, 'Nom', 1, 0, '', true);
// $pdf->SetFillColor(255, 255, 255); // Couleur de fond pour les données
// $pdf->SetTextColor(0, 0, 0); // Couleur de texte pour les données
// $pdf->Cell(60, 10, 'Liebaut', 1, 1);
// $pdf->SetFillColor(238, 242, 246);
// $pdf->SetTextColor(65, 132, 228);
// $pdf->Cell(40, 10, 'Prenom', 1, 0, '', true);
// $pdf->SetFillColor(255, 255, 255);
// $pdf->SetTextColor(0, 0, 0);
// $pdf->Cell(60, 10, 'Melusine', 1, 1);
// $pdf->SetFillColor(238, 242, 246);
// $pdf->SetTextColor(65, 132, 228);
// $pdf->Cell(40, 10, 'Date de naissance', 1, 0, '', true);
// $pdf->SetFillColor(255, 255, 255);
// $pdf->SetTextColor(0, 0, 0);
// $pdf->Cell(60, 10, '01/01/2000', 1, 1);
// $pdf->SetFillColor(238, 242, 246);
// $pdf->SetTextColor(65, 132, 228);
// $pdf->Cell(40, 10, 'Adresse', 1, 0, '', true);
// $pdf->SetFillColor(255, 255, 255);
// $pdf->SetTextColor(0, 0, 0);
// $pdf->Cell(60, 10, '3 place Jeanne D\'Arc', 1, 1);
// $pdf->SetFillColor(238, 242, 246);
// $pdf->SetTextColor(65, 132, 228);
// $pdf->Cell(40, 10, 'Genre', 1, 0, '', true);
// $pdf->SetFillColor(255, 255, 255);
// $pdf->SetTextColor(0, 0, 0);
// $pdf->Cell(60, 10, 'Femme', 1, 1);

// // Enregistrer le PDF
// $pdf->Output();

// Créer un objet FPDF
$pdf = new FPDF();

// Ajouter une page
$pdf->AddPage();

// Charger l'image du logo
$pdf->Image('./logo/logo-no-background.png', 10, 10, 50);

// Ajouter le titre de la facture avec le logo
$pdf->SetFont('Arial', 'B', 24);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(80);
$pdf->Cell(0, 40, 'Facture', 0, 1, 'C');
$pdf->Ln(10);

// Définir la police et la taille de police pour les étiquettes et les données
$pdf->SetFont('Courier', '', 12);

// Ajouter les informations de la facture
$pdf->Cell(70, 10, 'Nom du client :', 0, 0);
$pdf->Cell(0, 10, 'John Doe', 0, 1);
$pdf->Cell(70, 10, 'Adresse :', 0, 0);
$pdf->Cell(0, 10, '123 Rue du Commerce', 0, 1);
$pdf->Cell(70, 10, 'Ville :', 0, 0);
$pdf->Cell(0, 10, 'Paris', 0, 1);
$pdf->Cell(70, 10, 'Code postal :', 0, 0);
$pdf->Cell(0, 10, '75001', 0, 1);
$pdf->Cell(70, 10, 'Date :', 0, 0);
$pdf->Cell(0, 10, date('d/m/Y'), 0, 1);

// Ajouter de l'espace entre les informations de la facture et le tableau des produits
$pdf->Ln(20);

// Ajouter le tableau des produits
$pdf->SetFillColor(207, 241, 249);
$pdf->Cell(20, 10, 'Qte', 1, 0, 'C', true);
$pdf->Cell(100, 10, 'Produit', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Prix unitaire', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

// Ajouter les produits
$pdf->Cell(20, 10, '1', 1, 0, 'C');
$pdf->Cell(100, 10, 'Produit A', 1, 0);
$pdf->Cell(40, 10, '10.00 €', 1, 0, 'R');
$pdf->Cell(30, 10, '10.00 €', 1, 1, 'R');

$pdf->Cell(20, 10, '2', 1, 0, 'C');
$pdf->Cell(100, 10, 'Produit B', 1, 0);
$pdf->Cell(40, 10, '15.00 €', 1, 0, 'R');
$pdf->Cell(30, 10, '30.00 €', 1, 1, 'R');
$pdf->SetFillColor(240, 240, 240);
$pdf->Cell(120, 10, '', 0);
$pdf->Cell(40, 10, 'Total HT :', 1, 0, 'R', true);
$pdf->Cell(30, 10, '40.00 €', 1, 1, 'R', true);

$pdf->Cell(120, 10, '', 0);
$pdf->Cell(40, 10, 'TVA :', 1, 0, 'R', true);
$pdf->Cell(30, 10, '8.00 €', 1, 1, 'R', true);

$pdf->Cell(120, 10, '', 0);
$pdf->Cell(40, 10, 'Total TTC :', 1, 0, 'R', true);
$pdf->Cell(30, 10, '48.00 €', 1, 1, 'R', true);

// Ajouter un message de remerciement
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 16);
$pdf->SetTextColor(119, 119, 119);
$pdf->Cell(0, 10, 'Merci pour votre confiance !', 0, 1, 'C');

// Afficher le PDF
$pdf->Output();