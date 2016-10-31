<?php

/* 
 * Class for a Lisitng
 */
class Listing {
    private $streetNo; 
    private $streetName; 
    private $city; 
    private $zipCode;
    private $bedrooms;
    private $baths;
    private $sqFt;
    private $monthlyRent;
    private $description;
    private $deposit;
    private $petDeposit;
    private $keyDeposit;
    private $electricity; 
    private $internet; 
    private $water;
    private $gas;
    private $television;
    private $pets;
    private $smoking;
    private $furnished;
    private $startDate;
    private $endDate;
    
    /*
     * GETTERS
     */
    function getStreetNo() {
        return $this->streetNo;
    }

    function getStreetName() {
        return $this->streetName;
    }

    function getCity() {
        return $this->city;
    }

    function getZipCode() {
        return $this->zipCode;
    }

    function getBedrooms() {
        return $this->bedrooms;
    }

    function getBaths() {
        return $this->baths;
    }

    function getSqFt() {
        return $this->sqFt;
    }

    function getMonthlyRent() {
        return $this->monthlyRent;
    }

    function getDescription() {
        return $this->description;
    }

    function getDeposit() {
        return $this->deposit;
    }

    function getPetDeposit() {
        return $this->petDeposit;
    }

    function getKeyDeposit() {
        return $this->keyDeposit;
    }

    function getElectricity() {
        return $this->electricity;
    }

    function getInternet() {
        return $this->internet;
    }

    function getWater() {
        return $this->water;
    }

    function getGas() {
        return $this->gas;
    }

    function getTelevision() {
        return $this->television;
    }

    function getPets() {
        return $this->pets;
    }

    function getSmoking() {
        return $this->smoking;
    }

    function getFurnished() {
        return $this->furnished;
    }

    function getStartDate() {
        return $this->startDate;
    }

    function getEndDate() {
        return $this->endDate;
    }

    /*
     * Setters
     */
    
    function setStreetNo($streetNo) {
        $this->streetNo = $streetNo;
    }

    function setStreetName($streetName) {
        $this->streetName = $streetName;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    function setBedrooms($bedrooms) {
        $this->bedrooms = $bedrooms;
    }

    function setBaths($baths) {
        $this->baths = $baths;
    }

    function setSqFt($sqFt) {
        $this->sqFt = $sqFt;
    }

    function setMonthlyRent($monthlyRent) {
        $this->monthlyRent = $monthlyRent;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDeposit($deposit) {
        $this->deposit = $deposit;
    }

    function setPetDeposit($petDeposit) {
        $this->petDeposit = $petDeposit;
    }

    function setKeyDeposit($keyDeposit) {
        $this->keyDeposit = $keyDeposit;
    }

    function setElectricity($electricity) {
        $this->electricity = $electricity;
    }

    function setInternet($internet) {
        $this->internet = $internet;
    }

    function setWater($water) {
        $this->water = $water;
    }

    function setGas($gas) {
        $this->gas = $gas;
    }

    function setTelevision($television) {
        $this->television = $television;
    }

    function setPets($pets) {
        $this->pets = $pets;
    }

    function setSmoking($smoking) {
        $this->smoking = $smoking;
    }

    function setFurnished($furnished) {
        $this->furnished = $furnished;
    }

    function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    function setEndDate($endDate) {
        $this->endDate = $endDate;
    }


}